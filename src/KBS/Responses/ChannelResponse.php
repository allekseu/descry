<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Utils\DTO;
use Descry\KBS\Utils\Mapper;

/**
 * @method string|null  getAreaCode()
 * @method self         setAreaCode(?string $areaCode = null)
 * @method string|null  getAreaName()
 * @method self         setAreaName(?string $areaCode = null)
 * @method string|null  getChannelBroadcast()
 * @method self         setChannelBroadcast(?string $channelBroadcast = null)
 * @method string|null  getChannelCode()
 * @method self         setChannelCode(?string $channelCode = null)
 * @method string|null  getChannelGroup()
 * @method self         setChannelGroup(?string $channelGroup = null)
 * @method string|null  getChannelLogo()
 * @method self         setChannelLogo(?string $channelLogo = null)
 * @method string|null  getChannelName()
 * @method self         setChannelName(?string $channelName = null)
 * @method string|null  getChannelNid()
 * @method self         setChannelNid(?string $channelNid = null)
 * @method string|null  getChannelThumbnail()
 * @method self         setChannelThumbnail(?string $channelThumbnail = null)
 * @method string|null  getChannelType()
 * @method self         setChannelType(?string $channelType = null)
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
     * @var string|null $channelThumbnail
     */
    protected ?string $channelThumbnail = null;

    /**
     * @var string|null $channelType
     */
    protected ?string $channelType = null;

    /**
     * @param array $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            $this->setAreaCode(isset($apiResponse->local_station_code) ? (string) $apiResponse->local_station_code : null)
                ->setAreaName(isset($apiResponse->local_station_code) ? $apiResponse->local_station_code : null)
                ->setChannelBroadcast(isset($apiResponse->pps_kind_label) ? $apiResponse->pps_kind_label : null)
                ->setChannelCode(isset($apiResponse->channel_code) ? (string) $apiResponse->channel_code : null)
                ->setChannelGroup(isset($apiResponse->channel_group) ? $apiResponse->channel_group : null)
                ->setChannelLogo(isset($apiResponse->image_path_channel_logo) ? $apiResponse->image_path_channel_logo : null)
                ->setChannelName(
                    (isset($apiResponse->title) ? $apiResponse->title : null)
                    ?? (isset($apiResponse->channel_code_name) ? $apiResponse->channel_code_name : null)
                )
                ->setChannelNid(isset($apiResponse->nid) ? (string) $apiResponse->nid : null)
                ->setChannelThumbnail(isset($apiResponse->image_path_video_thumbnail) ? $apiResponse->image_path_video_thumbnail : null)
                ->setChannelType(
                    (isset($apiResponse->channel_type) ? $apiResponse->channel_type : null)
                    ?? (isset($apiResponse->media_code_name) ? $apiResponse->media_code_name : null)
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
    public function getAreaName(): ?string
    {
        return $this->areaName;
    }

    /**
     * @param string|null $areaCode
     * @return self
     */
    public function setAreaName(?string $areaCode = null): self
    {
        $this->areaName = Mapper::mapAreaName($areaCode);

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
     * @param string|null $channelBroadcast
     * @return self
     */
    public function setChannelBroadcast(?string $channelBroadcast = null): self
    {
        $this->channelBroadcast = Mapper::mapChannelBroadcast($channelBroadcast);

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
     * @return string|null
     */
    public function getChannelGroup(): ?string
    {
        return $this->channelGroup;
    }

    /**
     * @param string|null $channelGroup
     * @return self
     */
    public function setChannelGroup(?string $channelGroup = null): self
    {
        $this->channelGroup = $channelGroup;

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
     * @param string|null $channelLogo
     * @return self
     */
    public function setChannelLogo(?string $channelLogo = null): self
    {
        $this->channelLogo = $channelLogo;

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
     * @param string|null $channelName
     * @return self
     */
    public function setChannelName(?string $channelName = null): self
    {
        $this->channelName = $channelName;

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
     * @param string|null $channelNid
     * @return self
     */
    public function setChannelNid(?string $channelNid = null): self
    {
        $this->channelNid = $channelNid;

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
     * @param string|null $channelThumbnail
     * @return self
     */
    public function setChannelThumbnail(?string $channelThumbnail = null): self
    {
        $this->channelThumbnail = $channelThumbnail;

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
     * @param string|null $channelType
     * @return self
     */
    public function setChannelType(?string $channelType = null): self
    {
        $this->channelType = Mapper::mapChannelType($channelType);

        return $this;
    }
}
