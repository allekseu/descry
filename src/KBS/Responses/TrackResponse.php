<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\Utils\DTO;

/**
 * @method string|null  getTrackBitrate()
 * @method self         setTrackBitrate(?string $value = null)
 * @method string|null  getTrackCode()
 * @method self         setTrackCode(?string $value = null)
 * @method string|null  getTrackType()
 * @method self         setTrackType(?string $value = null)
 * @method string|null  getTrackUrl()
 * @method self         setTrackUrl(?string $value = null)
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
     * @var string|null $trackType
     */
    protected ?string $trackType = null;

    /**
     * @var string|null $trackUrl
     */
    protected ?string $trackUrl = null;

    /**
     * @param  array  $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            $this->setTrackBitrate(isset($apiResponse->bitrate) ? $apiResponse->bitrate : null)
                ->setTrackCode(isset($apiResponse->channel_id) ? (string) $apiResponse->channel_id : null)
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
     * @param  string|null  $value
     * @return self
     */
    public function setTrackBitrate(?string $value = null): self
    {
        $this->trackBitrate = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setTrackCode(?string $value = null): self
    {
        $this->trackCode = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setTrackType(?string $value = null): self
    {
        $this->trackType = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setTrackUrl(?string $value = null): self
    {
        $this->trackUrl = $value;

        return $this;
    }
}
