<?php

namespace Descry\KBS\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \Descry\KBS\Responses\ChannelResponse $this */
        return [
            "areaCode"          => $this->getAreaCode(),
            "areaName"          => $this->getAreaName(),
            "channelBroadcast"  => $this->getChannelBroadcast(),
            "channelCode"       => $this->getChannelCode(),
            "channelGroup"      => $this->getChannelGroup(),
            "channelLogo"       => $this->getChannelLogo(),
            "channelName"       => $this->getChannelName(),
            "channelNid"        => $this->getChannelNid(),
            "channelThumbnail"  => $this->getChannelThumbnail(),
            "channelType"       => $this->getChannelType()
        ];
    }
}
