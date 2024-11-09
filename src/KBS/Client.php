<?php

declare(strict_types=1);

namespace Descry\KBS;

use Descry\KBS\Parameters;
use Descry\KBS\Exceptions\ResponseException;
use Descry\KBS\Exceptions\ValidationException;
use Descry\KBS\Responses\ListingResponse;
use Descry\KBS\Responses\StreamResponse;
use Descry\Utils\Endpoint;
use Composer\CaBundle\CaBundle;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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
        $this->clientStatic = Http::baseUrl("https://static.api.kbs.co.kr/mediafactory/v1/")
            ->withOptions(["verify" => CaBundle::getSystemCaRootBundlePath()]);
        $this->clientMainV1 = Http::baseUrl("https://pwwwapi.kbs.co.kr/api/v1/")
            ->withOptions(["verify" => CaBundle::getSystemCaRootBundlePath()]);
        $this->clientMainV2 = Http::baseUrl("https://pwwwapi.kbs.co.kr/api/v2/")
            ->withOptions(["verify" => CaBundle::getSystemCaRootBundlePath()]);
    }

    /**
     * @param  \Illuminate\Http\Client\PendingRequest  $client
     * @param  object  $endpoint
     * @param  array  $parameters
     * @return array
     */
    private function request(PendingRequest $client, object $endpoint, array $parameters = []): array
    {
        $response = $client->send(
            $endpoint->method,
            $endpoint->url,
            ["query" => Arr::whereNotNull($parameters)]
        );

        if ($response->successful()) {
            $json = $response->json();

            if (Arr::exists($json, "ret") ? Arr::get($json, "ret") === 0 : !empty($json[0])) {
                return $json;
            } else {
                return [];
            }
        } else {
            return [Arr::get($response->json(), "error")];
        }
    }

    /**
     * @param  \Descry\KBS\Parameters  $parameters
     * @param  array  $queryParameters
     */
    private function validate(Parameters $parameters, array $queryParameters = []): void
    {
        foreach ($queryParameters as $queryParameter) {
            $function = "get" . Str::studly($queryParameter);

            if (is_array($parameters->$function()) ? empty($parameters->$function()) : !$parameters->$function()) {
                throw new ValidationException($queryParameter);
            }
        }
    }

    /**
     * @param  \Descry\KBS\Parameters  $parameters
     * @return \Descry\KBS\Responses\StreamResponse
     */
    public function getStream(Parameters $parameters): StreamResponse
    {
        $this->validate($parameters, ["area_code", "channel_code"]);

        $data = $this->request(
            $this->clientMainV1,
            Endpoint::format(Endpoint::KBS_GET_STREAM, [$parameters->getFormalChannelCode()])
        );

        return StreamResponse::hydrate($data);
    }

    /**
     * @param  \Descry\KBS\Parameters  $parameters
     * @return \Illuminate\Support\Collection
     */
    public function getListing(Parameters $parameters): Collection
    {
        $this->validate($parameters, ["area_code", "channel_codes"]);

        $isVodChannel = !empty(Arr::where($parameters->getChannelCodes(), function (string $channelCode) {
            return str_contains($channelCode, "nvod");
        }));

        $parameters = [
            "local_station_code"        => $parameters->getAreaCode(),
            "channel_code"              => implode(",", $parameters->getChannelCodes()),
            "program_planned_date_from" => $parameters->getProgramDateStart()?->format("Ymd") ?? Carbon::today()->format("Ymd"),
            "program_planned_date_to"   => $parameters->getProgramDateEnd()?->format("Ymd") ?? Carbon::today()->format("Ymd")
        ];

        $data = $this->request(
            $isVodChannel ? $this->clientMainV1 : $this->clientStatic,
            Endpoint::format($isVodChannel ? Endpoint::KBS_GET_SCHEDULE_VOD : Endpoint::KBS_GET_SCHEDULE_REGULAR),
            $parameters
        );

        if ($data && isset($data[0]) && is_array($data[0])) {
            return collect($data)->map(function (array $dataComponent) {
                return ListingResponse::hydrate($dataComponent);
            });
        } else {
            throw new ResponseException($data[0]);
        }
    }
}
