<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Utils\DTO;
use Descry\KBS\Utils\Scrapper;

/**
 * @method string|null  getTrackBitrate()
 * @method self         setTrackBitrate(?string $trackBitrate = null)
 * @method string|null  getTrackCode()
 * @method self         setTrackCode(?string $trackCode = null)
 * @method bool         getTrackHasDrm()
 * @method self         setTrackHasDrm(?string $trackUrl = null)
 * @method string|null  getTrackType()
 * @method self         setTrackType(?string $trackType = null)
 * @method string|null  getTrackUrl()
 * @method self         setTrackUrl(?string $trackUrl = null)
 */
class TrackResponse extends DTO
{
    /**
     * @var string|null $trackBitrate
     */
    protected ?string $trackBitrate = null;

    /**
     * @var string|null $trackCode
     */
    protected ?string $trackCode = null;

    /**
     * @var bool $trackHasDrm
     */
    protected bool $trackHasDrm = false;

    /**
     * @var string|null $trackType
     */
    protected ?string $trackType = null;

    /**
     * @var string|null $trackUrl
     */
    protected ?string $trackUrl = null;

    /**
     * @param array $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            $this->setTrackBitrate(isset($apiResponse->bitrate) ? $apiResponse->bitrate : null)
                ->setTrackCode(isset($apiResponse->channel_id) ? (string) $apiResponse->channel_id : null)
                ->setTrackHasDrm(isset($apiResponse->service_url) ? $apiResponse->service_url : null)
                ->setTrackType(isset($apiResponse->media_type) ? $apiResponse->media_type : null)
                ->setTrackUrl(isset($apiResponse->service_url) ? $apiResponse->service_url : null);
        }
    }

    /**
     * @return string|null
     */
    public function getTrackBitrate(): ?string
    {
        return $this->trackBitrate;
    }

    /**
     * @param string|null $trackBitrate
     * @return self
     */
    public function setTrackBitrate(?string $trackBitrate = null): self
    {
        $this->trackBitrate = $trackBitrate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackCode(): ?string
    {
        return $this->trackCode;
    }

    /**
     * @param string|null $trackCode
     * @return self
     */
    public function setTrackCode(?string $trackCode = null): self
    {
        $this->trackCode = $trackCode;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTrackHasDrm(): bool
    {
        return $this->trackHasDrm;
    }

    /**
     * @param string|null $trackUrl
     * @return self
     */
    public function setTrackHasDrm(?string $trackUrl = null): self
    {
        $this->trackHasDrm = Scrapper::hasDrm($trackUrl);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackType(): ?string
    {
        return $this->trackType;
    }

    /**
     * @param string|null $trackType
     * @return self
     */
    public function setTrackType(?string $trackType = null): self
    {
        $this->trackType = $trackType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackUrl(): ?string
    {
        return $this->trackUrl;
    }

    /**
     * @param string|null $trackUrl
     * @return self
     */
    public function setTrackUrl(?string $trackUrl = null): self
    {
        $this->trackUrl = $trackUrl;

        return $this;
    }
}
