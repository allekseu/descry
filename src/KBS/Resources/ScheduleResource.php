<?php

namespace Descry\KBS\Resources;

use Descry\KBS\Resources\ProgramResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \Descry\KBS\Responses\ScheduleResponse $this */
        return [
            "program"               => $this->getProgram() ? ProgramResource::make($this->getProgram()) : null,
            "scheduleDateEnd"       => $this->getScheduleDatetimeEnd()?->format("Y-m-d"),
            "scheduleDateStart"     => $this->getScheduleDatetimeStart()?->format("Y-m-d"),
            "scheduleDuration"      => $this->getScheduleDatetimeEnd() ? (int) $this->getScheduleDatetimeStart()?->diffInRealMinutes($this->getScheduleDatetimeEnd()) : null,
            "scheduleId"            => $this->getScheduleId(),
            "scheduleTimeEnd"       => $this->getScheduleDatetimeEnd()?->format("H:i:s"),
            "scheduleTimeStart"     => $this->getScheduleDatetimeStart()?->format("H:i:s")
        ];
    }
}
