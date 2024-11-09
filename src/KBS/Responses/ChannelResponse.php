<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Mapper;
use Descry\Utils\DTO;
use Illuminate\Support\Str;

/**
 * @method string|null  getAreaCode()
 * @method self         setAreaCode(?string $value = null)
 * @method string|null  getAreaName()
 * @method self         setAreaName(?string $value = null)
 * @method string|null  getChannelBroadcast()
 * @method self         setChannelBroadcast(?string $value = null)
 * @method string|null  getChannelCode()
 * @method self         setChannelCode(?string $value = null)
 * @method string|null  getChannelGroup()
 * @method self         setChannelGroup(?string $value = null)
 * @method string|null  getChannelLogo()
 * @method self         setChannelLogo(?string $value = null)
 * @method string|null  getChannelName()
 * @method self         setChannelName(?string $value = null)
 * @method string|null  getChannelNid()
 * @method self         setChannelNid(?string $value = null)
 * @method string|null  getChannelRegion()
 * @method self         setChannelRegion(?string $value = null)
 * @method string|null  getChannelThumbnail()
 * @method self         setChannelThumbnail(?string $value = null)
 * @method string|null  getChannelType()
 * @method self         setChannelType(?string $value = null)
 */
class ChannelResponse extends DTO
{
    /**
     * @var string|null $areaCode
     */
    protected ?string $areaCode = null;

    /**
     * @var string|null $areaName
     */
    protected ?string $areaName = null;

    /**
     * @var string|null $channelBroadcast
     */
    protected ?string $channelBroadcast = null;

    /**
     * @var string|null $channelCode
     */
    protected ?string $channelCode = null;

    /**
     * @var string|null $channelGroup
     */
    protected ?string $channelGroup = null;

    /**
     * @var string|null $channelLogo
     */
    protected ?string $channelLogo = null;

    /**
     * @var string|null $channelName
     */
    protected ?string $channelName = null;

    /**
     * @var string|null $channelNid
     */
    protected ?string $channelNid = null;

    /**
     * @var string|null $channelRegion
     */
    protected ?string $channelRegion = null;

    /**
     * @var string|null $channelThumbnail
     */
    protected ?string $channelThumbnail = null;

    /**
     * @var string|null $channelType
     */
    protected ?string $channelType = null;

    /**
     * @param  array  $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            if (isset($apiResponse->channel_code) && Str::contains($apiResponse->channel_code, "_")) {
                $apiResponse->local_station_code = explode("_", $apiResponse->channel_code)[0];
                $apiResponse->channel_code = explode("_", $apiResponse->channel_code)[1];
            }

            $this->setAreaCode(isset($apiResponse->local_station_code) ? (string) $apiResponse->local_station_code : null)
                ->setAreaName(isset($apiResponse->local_station_code) ? $apiResponse->local_station_code : null)
                ->setChannelBroadcast(
                    (isset($apiResponse->pps_kind_label) ? $apiResponse->pps_kind_label : null)
                    ?? (isset($apiResponse->channel_code) ? (string) $apiResponse->channel_code : null)
                )
                ->setChannelCode(isset($apiResponse->channel_code) ? (string) $apiResponse->channel_code : null)
                ->setChannelGroup(
                    (isset($apiResponse->channel_group) ? $apiResponse->channel_group : null)
                    ?? (isset($apiResponse->local_station_code) ? $apiResponse->local_station_code : null)
                )
                ->setChannelLogo(isset($apiResponse->image_path_channel_logo) ? $apiResponse->image_path_channel_logo : null)
                ->setChannelName(
                    (isset($apiResponse->title) ? $apiResponse->title : null)
                    ?? (isset($apiResponse->channel_code_name) ? $apiResponse->channel_code_name : null)
                )
                ->setChannelNid(isset($apiResponse->nid) ? (string) $apiResponse->nid : null)
                ->setChannelRegion(
                    (isset($apiResponse->channel_type) ? (string) $apiResponse->channel_type : null)
                    ?? (isset($apiResponse->local_station_code) ? $apiResponse->local_station_code : null)
                )
                ->setChannelThumbnail(isset($apiResponse->image_path_video_thumbnail) ? $apiResponse->image_path_video_thumbnail : null)
                ->setChannelType(
                    (isset($apiResponse->channel_type) && $apiResponse->channel_type != "COUNTRY" ? $apiResponse->channel_type : null)
                    ?? (isset($apiResponse->media_code_name) ? $apiResponse->media_code_name : null)
                    ?? (isset($apiResponse->title) ? $apiResponse->title : null)
                );
        }
    }

    /**
     * @return string|null
     */
    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setAreaCode(?string $value = null): self
    {
        $this->areaCode = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAreaName(): ?string
    {
        return $this->areaName;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setAreaName(?string $value = null): self
    {
        $this->areaName = Mapper::mapAreaName($value);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelBroadcast(): ?string
    {
        return $this->channelBroadcast;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelBroadcast(?string $value = null): self
    {
        $this->channelBroadcast = Mapper::mapChannelBroadcast($value);

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
     * @param  string|null  $value
     * @return self
     */
    public function setChannelCode(?string $value = null): self
    {
        $this->channelCode = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelGroup(): ?string
    {
        return $this->channelGroup;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelGroup(?string $value = null): self
    {
        $this->channelGroup = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelLogo(): ?string
    {
        return $this->channelLogo;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelLogo(?string $value = null): self
    {
        $this->channelLogo = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelName(): ?string
    {
        return $this->channelName;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelName(?string $value = null): self
    {
        $this->channelName = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelNid(): ?string
    {
        return $this->channelNid;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelNid(?string $value = null): self
    {
        $this->channelNid = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelRegion(): ?string
    {
        return $this->channelRegion;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelRegion(?string $value = null): self
    {
        $this->channelRegion = Mapper::mapChannelRegion($value);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelThumbnail(): ?string
    {
        return $this->channelThumbnail;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelThumbnail(?string $value = null): self
    {
        $this->channelThumbnail = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannelType(): ?string
    {
        return $this->channelType;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setChannelType(?string $value = null): self
    {
        $this->channelType = Mapper::mapChannelType($value);

        return $this;
    }
}
