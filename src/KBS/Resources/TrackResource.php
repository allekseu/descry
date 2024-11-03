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
        return [
            "trackBitrate"  => $this->getTrackBitrate(),
            "trackCode"     => $this->getTrackCode(),
            "trackHasDrm"   => $this->getTrackHasDrm(),
            "trackType"     => $this->getTrackType(),
            "trackUrl"      => $this->getTrackUrl()
        ];
    }
}
