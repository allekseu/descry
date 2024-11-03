<?php

namespace Descry\KBS\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "programBroadcast"      => $this->getProgramBroadcast(),
            "programCode"           => $this->getProgramCode(),
            "programHasSubtitle"    => $this->getProgramHasSubtitle(),
            "programHasVideo"       => $this->getProgramHasVideo(),
            "programId"             => $this->getProgramId(),
            "programResolution"     => $this->getProgramResolution(),
            "programThumbnail"      => $this->getProgramThumbnail(),
            "programTitle"          => $this->getProgramTitle(),
            "programUrl"            => $this->getProgramUrl()
        ];
    }
}
