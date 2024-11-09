<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Mapper;
use Descry\KBS\Responses\ProgramResponse;
use Descry\Utils\DTO;
use Illuminate\Support\Carbon;

/**
 * @method \Descry\KBS\Responses\ProgramResponse|null   getProgram()
 * @method self                                         setProgram(array $value = [])
 * @method string|null                                  getScheduleBroadcast()
 * @method self                                         setScheduleBroadcast(?string $value = null)
 * @method \Illuminate\Support\Carbon|null              getScheduleDatetimeEnd()
 * @method self                                         setScheduleDatetimeEnd(\Illuminate\Support\Carbon|null $value = null)
 * @method \Illuminate\Support\Carbon|null              getScheduleDatetimeStart()
 * @method self                                         setScheduleDatetimeStart(\Illuminate\Support\Carbon|null $value = null)
 * @method string|null                                  getScheduleId()
 * @method self                                         setScheduleId(?string $value = null)
 */
class ScheduleResponse extends DTO

{
    /**
     * @var \Descry\KBS\Responses\ProgramResponse|null $program
     */
    protected ?ProgramResponse $program = null;

    /**
     * @var string|null $scheduleBroadcast
     */
    protected ?string $scheduleBroadcast = null;

    /**
     * @var \Illuminate\Support\Carbon|null $scheduleDatetimeEnd
     */
    protected ?Carbon $scheduleDatetimeEnd = null;

    /**
     * @var \Illuminate\Support\Carbon|null $scheduleDatetimeStart
     */
    protected ?Carbon $scheduleDatetimeStart = null;

    /**
     * @var string|null $scheduleId
     */
    protected ?string $scheduleId = null;

    /**
     * @param  array  $trackResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            $this->setProgram((array) $apiResponse)
                ->setScheduleBroadcast(isset($apiResponse->rerun_classification) ? $apiResponse->rerun_classification : null)
                ->setScheduleDatetimeEnd(isset($apiResponse->program_planned_date, $apiResponse->program_planned_end_time) ? Carbon::createFromFormat("YmdHisu", $apiResponse->program_planned_date . $apiResponse->program_planned_end_time) : null)
                ->setScheduleDatetimeStart(isset($apiResponse->program_planned_date, $apiResponse->program_planned_start_time) ? Carbon::createFromFormat("YmdHisu", $apiResponse->program_planned_date . $apiResponse->program_planned_start_time) : null)
                ->setScheduleId(isset($apiResponse->schedule_unique_id) ? (string) $apiResponse->schedule_unique_id : null);
        }
    }

    /**
     * @return \Descry\KBS\Responses\ProgramResponse|null
     */
    public function getProgram(): ?ProgramResponse
    {
        return $this->program;
    }

    /**
     * @param  array  $value
     * @return self
     */
    public function setProgram(array $value = []): self
    {
        $this->program = ProgramResponse::hydrate($value);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getScheduleBroadcast(): ?string
    {
        return $this->scheduleBroadcast;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setScheduleBroadcast(?string $value = null): self
    {
        $this->scheduleBroadcast = Mapper::mapScheduleBroadcast($value);

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getScheduleDatetimeEnd(): ?Carbon
    {
        return $this->scheduleDatetimeEnd;
    }

    /**
     * @param  \Illuminate\Support\Carbon  $value
     * @return self
     */
    public function setScheduleDatetimeEnd(?Carbon $value = null): self
    {
        $this->scheduleDatetimeEnd = $value;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getScheduleDatetimeStart(): ?Carbon
    {
        return $this->scheduleDatetimeStart;
    }

    /**
     * @param  \Illuminate\Support\Carbon  $value
     * @return self
     */
    public function setScheduleDatetimeStart(?Carbon $value = null): self
    {
        $this->scheduleDatetimeStart = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getScheduleId(): ?string
    {
        return $this->scheduleId;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setScheduleId(?string $value = null): self
    {
        $this->scheduleId = $value;

        return $this;
    }
}
