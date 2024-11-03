<?php

namespace Descry\KBS;

use Descry\KBS\Exceptions\ResponseException;
use Descry\KBS\Exceptions\ValidationException;
use Descry\KBS\Responses\ListingResponse;
use Descry\KBS\Responses\StreamResponse;
use Descry\Utils\Endpoints;
use Descry\KBS\Utils\Parameters;
use Composer\CaBundle\CaBundle;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Client
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private PendingRequest $clientStatic;

    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private PendingRequest $clientMainV1;

    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    private PendingRequest $clientMainV2;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->clientStatic = Http::baseUrl("https://static.api.kbs.co.kr/mediafactory/v1/")->withOptions(["verify" => CaBundle::getSystemCaRootBundlePath()]);
        $this->clientMainV1 = Http::baseUrl("https://pwwwapi.kbs.co.kr/api/v1/")->withOptions(["verify" => CaBundle::getSystemCaRootBundlePath()]);
        $this->clientMainV2 = Http::baseUrl("https://pwwwapi.kbs.co.kr/api/v2/")->withOptions(["verify" => CaBundle::getSystemCaRootBundlePath()]);
    }

    /**
     * @param \Illuminate\Http\Client\PendingRequest $client
     * @param string $endpoint
     * @param array $parameters
     */
    private function request(PendingRequest $client, string $endpoint, array $parameters = [])
    {
        $cache = Cache::get("kbs.{$endpoint}." . implode("", $parameters));

        if (!$cache) {
            $response = $client->withQueryParameters($parameters)->get($endpoint);

            if ($response->getStatusCode() == Response::HTTP_OK) {
                Log::info("API KBS CALL " . $response->getStatusCode() . " ON " . $response->effectiveUri()->__toString());
                return Cache::remember("kbs" . implode("", $parameters), 60, function () use ($response) {
                    return $response->json();
                });
            } else {
                Log::error("API KBS ERROR " . $response->getStatusCode() . " ON " . $response->effectiveUri()->__toString());
                return [Arr::get($response->json(), "error")];
            }
        } else {
            return $cache;
        }
    }

    /**
     * @param \Descry\KBS\Utils\Parameters $parameters
     * @return \Descry\KBS\Responses\StreamResponse
     */
    public function getStream(Parameters $parameters): StreamResponse
    {
        $channelCode = $parameters->getAreaCode() != "00" ? "{$parameters->getAreaCode()}_{$parameters->getChannelCode()}" : $parameters->getChannelCode();

        $response = $this->request(
            $this->clientMainV1,
            Endpoints::KBS_GET_STREAM . $channelCode
        );

        return new StreamResponse($response);
    }

    /**
     * @param \Descry\KBS\Utils\Parameters $parameters
     * @return \Illuminate\Support\Collection
     */
    public function getListing(Parameters $parameters): Collection
    {
        if (!$parameters->getAreaCode()) {
            throw new ValidationException("Missing request parameter: area_code", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (empty($parameters->getChannelCodes())) {
            throw new ValidationException("Missing request parameter: channel_codes", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $isVodChannel = !empty(Arr::where($parameters->getChannelCodes(), function (string $channelCode) {
            return str_contains($channelCode, "nvod");
        }));

        $parameters = [
            "local_station_code"        => $parameters->getAreaCode(),
            "channel_code"              => implode(",", $parameters->getChannelCodes()),
            "program_planned_date_from" => $parameters->getProgramDateStart()?->format("Ymd") ?? Carbon::today()->format("Ymd"),
            "program_planned_date_to"   => $parameters->getProgramDateEnd()?->format("Ymd") ?? Carbon::today()->format("Ymd")
        ];

        $response = $this->request(
            $isVodChannel ? $this->clientMainV1 : $this->clientStatic,
            $isVodChannel ? Endpoints::KBS_GET_SCHEDULE_VOD : Endpoints::KBS_GET_SCHEDULE_REGULAR,
            $parameters
        );

        if ($response && isset($response[0]) && is_array($response[0])) {
            return collect($response)->map(function (array $listing) {
                return new ListingResponse($listing);
            });
        } else {
            throw new ResponseException("API Response Error: " . $response[0], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // /**
    //  * @param string|null $programeCode
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function getProgram(?string $programeCode = null): Collection
    // {
    //     $parameters = [
    //         "program_code" => $programeCode
    //     ];

    //     $response = $this->request("contents", $parameters);

    //     return collect(Arr::get($response, "data"))->map(function (array $program) {
    //         return Mapper::mapProgram($program);
    //     });
    // }
}
