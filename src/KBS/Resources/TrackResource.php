<?php

namespace Descry\KBS\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \Descry\KBS\Responses\TrackResponse $this */
        return [
            "trackBitrate"  => $this->getTrackBitrate(),
            "trackCode"     => $this->getTrackCode(),
            "trackType"     => $this->getTrackType(),
            "trackUrl"      => $this->getTrackUrl()
        ];
    }
}
