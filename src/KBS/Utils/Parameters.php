<?php

declare(strict_types=1);

namespace Descry\KBS\Utils;

use Descry\Utils\DTO;
use Illuminate\Support\Carbon;

/**
 * @method string|null                      getAreaCode()
 * @method self                             setAreaCode(?string $areaCode = null)
 * @method string|null                      getChannelCode()
 * @method self                             setChannelCode(?string $channelCode = null)
 * @method array                            getChannelCodes()
 * @method self                             setChannelCodes(array $channelCodes = [])
 * @method \Illuminate\Support\Carbon|null  getProgramDateEnd()
 * @method self                             setProgramDateEnd(\Illuminate\Support\Carbon|string|null $programDateEnd = null)
 * @method \Illuminate\Support\Carbon|null  getProgramDateStart()
 * @method self                             setProgramDateStart(\Illuminate\Support\Carbon|string|null $programDateStart = null)
 */
class Parameters extends DTO
{
    /**
     * @var string|null $areaCode
     */
    protected string|null $areaCode = null;

    /**
     * @var string|null $channelCode
     */
    protected string|null $channelCode = null;

    /**
     * @var array $channelCodes
     */
    protected array $channelCodes = [];

    /**
     * @var \Illuminate\Support\Carbon|null $programDateEnd
     */
    protected ?Carbon $programDateEnd = null;

    /**
     * @var \Illuminate\Support\Carbon|null $programDateStart
     */
    protected ?Carbon $programDateStart = null;

    /**
     * @return string|null
     */
    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    /**
     * @param string|null $areaCode
     * @return self
     */
    public function setAreaCode(?string $areaCode = null): self
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelCode(): ?string
    {
        return $this->channelCode;
    }

    /**
     * @param string|null $channelCode
     * @return self
     */
    public function setChannelCode(?string $channelCode = null): self
    {
        $this->channelCode = $channelCode;

        return $this;
    }

    /**
     * @return array
     */
    public function getChannelCodes(): array
    {
        return $this->channelCodes;
    }

    /**
     * @param array $channelCodes
     * @return self
     */
    public function setChannelCodes(array $channelCodes = []): self
    {
        $this->channelCodes = $channelCodes;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getProgramDateEnd(): ?Carbon
    {
        return $this->programDateEnd;
    }

    /**
     * @param \Illuminate\Support\Carbon|string|null $programDateEnd
     * @return self
     */
    public function setProgramDateEnd(Carbon|string|null $programDateEnd = null): self
    {
        if ($programDateEnd && !($programDateEnd instanceof Carbon)) {
            $programDateEnd = Carbon::make($programDateEnd);
        }

        if ($this->programDateStart && !$programDateEnd) {
            $programDateEnd = $this->programDateStart;
        }

        if ($this->programDateStart && $programDateEnd && $this->programDateStart > $programDateEnd) {
            $programDateEnd = $this->programDateStart;
        }

        $this->programDateEnd = $programDateEnd;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getProgramDateStart(): ?Carbon
    {
        return $this->programDateStart;
    }

    /**
     * @param \Illuminate\Support\Carbon|string|null $programDateStart
     * @return self
     */
    public function setProgramDateStart(Carbon|string|null $programDateStart = null): self
    {
        if ($programDateStart && !($programDateStart instanceof Carbon)) {
            $programDateStart = Carbon::make($programDateStart);
        }

        if ($programDateStart && !$this->programDateEnd) {
            $this->programDateEnd = $programDateStart;
        }

        if ($this->programDateEnd && $programDateStart && $this->programDateEnd < $programDateStart) {
            $this->programDateEnd = $programDateStart;
        }

        $this->programDateStart = $programDateStart;

        return $this;
    }
}
