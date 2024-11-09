<?php

declare(strict_types=1);

namespace Descry\KBS\Responses;

use Descry\KBS\Mapper;
use Descry\Utils\DTO;

/**
 * @method string|null  getProgramAspectRatio()
 * @method self         setProgramAspectRatio(?string $value = null)
 * @method string|null  getProgramBroadcast()
 * @method self         setProgramBroadcast(?string $value = null)
 * @method string|null  getProgramCode()
 * @method self         setProgramCode(?string $value = null)
 * @method bool         getProgramHasSubtitle()
 * @method self         setProgramHasSubtitle(bool $value = false)
 * @method bool         getProgramHasVideo()
 * @method self         setProgramHasVideo(bool $value = true)
 * @method string|null  getProgramId()
 * @method self         setProgramId(?string $value = null)
 * @method string|null  getProgramResolution()
 * @method self         setProgramResolution(?string $value = null)
 * @method string|null  getProgramTitle()
 * @method self         setProgramTitle(?string $value = null)
 * @method string|null  getProgramThumbnail()
 * @method self         setProgramThumbnail(?string $value = null)
 * @method string|null  getProgramUrl()
 * @method self         setProgramUrl(?string $value = null)
 */
class ProgramResponse extends DTO
{
    /**
     * @var string|null $programAspectRatio
     */
    protected ?string $programAspectRatio = null;

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
     * @param  array  $apiResponse
     * @return void
     */
    public function __construct(array $apiResponse = [])
    {
        if (!empty($apiResponse)) {
            $apiResponse = (object) $apiResponse;

            $this->setProgramAspectRatio(isset($apiResponse->aspect_ratio) ? $apiResponse->aspect_ratio : "16:9")
                ->setProgramBroadcast(isset($apiResponse->production_type) ? $apiResponse->production_type : null)
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
    public function getProgramAspectRatio(): ?string
    {
        return $this->programAspectRatio;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setProgramAspectRatio(?string $value = null): self
    {
        $this->programAspectRatio = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProgramBroadcast(): ?string
    {
        return $this->programBroadcast;
    }

    /**
     * @param  string|null  $value
     * @return self
     */
    public function setProgramBroadcast(?string $value = null): self
    {
        $this->programBroadcast = Mapper::mapProgramBroadcast($value);

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
     * @param  string|null  $value
     * @return self
     */
    public function setProgramCode(?string $value = null): self
    {
        $this->programCode = $value;

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
     * @param  bool  $value
     * @return self
     */
    public function setProgramHasSubtitle(bool $value = false): self
    {
        $this->programHasSubtitle = $value;

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
     * @param  bool  $value
     * @return self
     */
    public function setProgramHasVideo(bool $value = true): self
    {
        $this->programHasVideo = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setProgramId(?string $value = null): self
    {
        $this->programId = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setProgramResolution(?string $value = null): self
    {
        $this->programResolution = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setProgramTitle(?string $value = null): self
    {
        $this->programTitle = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setProgramThumbnail(?string $value = null): self
    {
        $this->programThumbnail = $value;

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
     * @param  string|null  $value
     * @return self
     */
    public function setProgramUrl(?string $value = null): self
    {
        $this->programUrl = $value;

        return $this;
    }
}
