<?php

namespace Descry\KBS\Resources;

use Descry\KBS\Resources\ChannelResource;
use Descry\KBS\Resources\TrackResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StreamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "channel"           => $this->getChannel() ? ChannelResource::make($this->getChannel()) : null,
            "channelTracks"     => TrackResource::collection($this->getChannelTracks())
        ];
    }
}
