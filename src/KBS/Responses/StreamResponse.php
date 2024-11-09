<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Responses\ChannelResponse;
use Descry\KBS\Responses\TrackResponse;
use Descry\Utils\DTO;
use Illuminate\Support\Arr;

/**
 * @method \Descry\KBS\Responses\ChannelResponse|null   getChannel()
 * @method self                                         setChannel(array $value = [])
 * @method array                                        getChannelTracks()
 * @method self                                         setChannelTracks(array $value = [])
 */
class StreamResponse extends DTO
{
    /**
     * @var \Descry\KBS\Responses\ChannelResponse|null $channel
     */
    protected ?ChannelResponse $channel = null;

    /**
     * @var array $channelTracks
     */
    protected array $channelTracks = [];

    /**
     * @param  array  $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            if (!empty($apiResponse->channelMaster) && !empty($apiResponse->channel_item)) {
                $this->setChannel($apiResponse->channelMaster)
                    ->setChannelTracks($apiResponse->channel_item);
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
    public function getChannelTracks(): array
    {
        return $this->channelTracks;
    }

    /**
     * @param  array  $value
     * @return self
     */
    public function setChannelTracks(array $value = []): self
    {
        $this->channelTracks = Arr::map($value, function (array $component) {
            return TrackResponse::hydrate($component);
        });

        return $this;
    }
}
