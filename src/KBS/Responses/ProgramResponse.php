<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Utils\DTO;
use Descry\KBS\Utils\Mapper;

/**
 * @method string|null  getProgramBroadcast()
 * @method self         setProgramBroadcast(?string $programBroadcast = null)
 * @method string|null  getProgramCode()
 * @method self         setProgramCode(?string $programCode = null)
 * @method bool         getProgramHasSubtitle()
 * @method self         setProgramHasSubtitle(bool $programHasSubtitle = false)
 * @method bool         getProgramHasVideo()
 * @method self         setProgramHasVideo(bool $programHasVideo = true)
 * @method string|null  getProgramId()
 * @method self         setProgramId(?string $programId = null)
 * @method string|null  getProgramResolution()
 * @method self         setProgramResolution(?string $programResolution = null)
 * @method string|null  getProgramTitle()
 * @method self         setProgramTitle(?string $programTitle = null)
 * @method string|null  getProgramThumbnail()
 * @method self         setProgramThumbnail(?string $programThumbnail = null)
 * @method string|null  getProgramUrl()
 * @method self         setProgramUrl(?string $programUrl = null)
 */
class ProgramResponse extends DTO
{
    /**
     * @var string|null $programBroadcast
     */
    protected ?string $programBroadcast = null;

    /**
     * @var string|null $programCode
     */
    protected ?string $programCode = null;

    /**
     * @var bool $programHasSubtitle
     */
    protected bool $programHasSubtitle = false;

    /**
     * @var bool $programHasVideo
     */
    protected bool $programHasVideo = true;

    /**
     * @var string|null $programId
     */
    protected ?string $programId = null;

    /**
     * @var string|null $programResolution
     */
    protected ?string $programResolution = null;

    /**
     * @var string|null $programTitle
     */
    protected ?string $programTitle = null;

    /**
     * @var string|null $programThumbnail
     */
    protected ?string $programThumbnail = null;

    /**
     * @var string|null $programUrl
     */
    protected ?string $programUrl = null;

    /**
     * @param array $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            $this->setProgramBroadcast(isset($apiResponse->production_type) ? $apiResponse->production_type : null)
                ->setProgramCode(isset($apiResponse->program_code) ? (string) $apiResponse->program_code : null)
                ->setProgramHasSubtitle(isset($apiResponse->closed_caption_yn) ? $apiResponse->closed_caption_yn == "Y" : false)
                ->setProgramHasVideo(isset($apiResponse->radio_open_studio_yn, $apiResponse->media_code_name) ? !($apiResponse->media_code_name == "RADIO" && $apiResponse->radio_open_studio_yn == "N") : true)
                ->setProgramId(isset($apiResponse->program_id) ? (string) $apiResponse->program_id : null)
                ->setProgramResolution(isset($apiResponse->production_video_quality) ? $apiResponse->production_video_quality : null)
                ->setProgramTitle(isset($apiResponse->program_title) ? $apiResponse->program_title : null)
                ->setProgramThumbnail(isset($apiResponse->image_w) ? $apiResponse->image_w : null)
                ->setProgramUrl(isset($apiResponse->homepage_url) ? $apiResponse->homepage_url : null);
        } else {
            parent::__construct();
        }
    }

    /**
     * @return string|null
     */
    public function getProgramBroadcast(): ?string
    {
        return $this->programBroadcast;
    }

    /**
     * @param string|null $programBroadcast
     * @return self
     */
    public function setProgramBroadcast(?string $programBroadcast = null): self
    {
        $this->programBroadcast = Mapper::mapProgramBroadcast($programBroadcast);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProgramCode(): ?string
    {
        return $this->programCode;
    }

    /**
     * @param string|null $programCode
     * @return self
     */
    public function setProgramCode(?string $programCode = null): self
    {
        $this->programCode = $programCode;

        return $this;
    }

    /**
     * @return bool
     */
    public function getProgramHasSubtitle(): bool
    {
        return $this->programHasSubtitle;
    }

    /**
     * @param bool $programHasSubtitle
     * @return self
     */
    public function setProgramHasSubtitle(bool $programHasSubtitle = false): self
    {
        $this->programHasSubtitle = $programHasSubtitle;

        return $this;
    }

    /**
     * @return bool
     */
    public function getProgramHasVideo(): bool
    {
        return $this->programHasVideo;
    }

    /**
     * @param bool $programHasVideo
     * @return self
     */
    public function setProgramHasVideo(bool $programHasVideo = true): self
    {
        $this->programHasVideo = $programHasVideo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProgramId(): ?string
    {
        return $this->programId;
    }

    /**
     * @param string|null $programId
     * @return self
     */
    public function setProgramId(?string $programId = null): self
    {
        $this->programId = $programId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProgramResolution(): ?string
    {
        return $this->programResolution;
    }

    /**
     * @param string|null $programResolution
     * @return self
     */
    public function setProgramResolution(?string $programResolution = null): self
    {
        $this->programResolution = $programResolution;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProgramTitle(): ?string
    {
        return $this->programTitle;
    }

    /**
     * @param string|null $programTitle
     * @return self
     */
    public function setProgramTitle(?string $programTitle = null): self
    {
        $this->programTitle = $programTitle;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProgramThumbnail(): ?string
    {
        return $this->programThumbnail;
    }

    /**
     * @param string|null $programThumbnail
     * @return self
     */
    public function setProgramThumbnail(?string $programThumbnail = null): self
    {
        $this->programThumbnail = $programThumbnail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProgramUrl(): ?string
    {
        return $this->programUrl;
    }

    /**
     * @param string|null $programUrl
     * @return self
     */
    public function setProgramUrl(?string $programUrl = null): self
    {
        $this->programUrl = $programUrl;

        return $this;
    }
}
