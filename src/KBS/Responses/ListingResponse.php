<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Responses\ChannelResponse;
use Descry\Utils\DTO;
use Illuminate\Support\Arr;

/**
 * @method \Descry\KBS\Responses\ChannelResponse|null   getChannel()
 * @method self                                         setChannel(array $value = [])
 * @method array                                        getChannelSchedules()
 * @method self                                         setChannelSchedules(array $value = [])
 */
class ListingResponse extends DTO
{
    /**
     * @var \Descry\KBS\Responses\ChannelResponse|null $channel
     */
    protected ?ChannelResponse $channel = null;

    /**
     * @var array $channelSchedules
     */
    protected array $channelSchedules = [];

    /**
     * @param  array  $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            if (!empty($apiResponse->schedules)) {
                // FIX FOR THE STATIC API SCHEDULE ALWAYS RETURNING "00" AS AREA CODE
                Arr::set($apiResponse->schedules[0], "local_station_code", $apiResponse->local_station_code);

                $this->setChannel($apiResponse->schedules[0])
                    ->setChannelSchedules($apiResponse->schedules);
            }
        }
    }

    /**
     * @return \Descry\KBS\Responses\ChannelResponse|null
     */
    public function getChannel(): ?ChannelResponse
    {
        return $this->channel;
    }

    /**
     * @param  array  $value
     * @return self
     */
    public function setChannel(array $value = []): self
    {
        $this->channel = ChannelResponse::hydrate($value);

        return $this;
    }

    /**
     * @return array
     */
    public function getChannelSchedules(): array
    {
        return $this->channelSchedules;
    }

    /**
     * @param  array  $value
     * @return self
     */
    public function setChannelSchedules(array $value = []): self
    {
        $this->channelSchedules = Arr::map($value, function (array $component) {
            return ScheduleResponse::hydrate($component);
        });

        return $this;
    }
}
