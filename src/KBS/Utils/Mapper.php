<?php

declare(strict_types=1);

namespace Descry\KBS\Utils;

/**
 * @method string|null mapAreaName(?string $areaCode = null)
 * @method string|null mapChannelBroadcast(?string $channelBroadcast = null)
 * @method string|null mapChannelName(?string $channelCode = null)
 * @method string|null mapChannelType(?string $channelType = null)
 * @method string|null mapProgramBroadcast(?string $programBroadcast = null)
 * @method string|null mapScheduleBroadcast(?string $scheduleBroadcast = null)
 */
class Mapper
{
    /**
     * @param string|null $areaCode
     * @return string|null
     */
    public static function mapAreaName(?string $areaCode = null): ?string
    {
        return [
            "00" => "korea",
            "10" => "busan",
            "11" => "ulsan",
            "20" => "changwon",
            "21" => "jinju",
            "30" => "daegu",
            "31" => "andong",
            "32" => "pohang",
            "40" => "gwangju",
            "41" => "mokpo",
            "43" => "suncheon",
            "50" => "jeonju",
            "60" => "daejeon",
            "70" => "cheongju",
            "71" => "chungju",
            "80" => "chuncheon",
            "81" => "gangneung",
            "82" => "wonju",
            "90" => "jeju"
        ][$areaCode] ?? null;
    }

    /**
     * @param string|null $channelBroadcast
     * @return string|null
     */
    public static function mapChannelBroadcast(?string $channelBroadcast = null): ?string
    {
        return [
            "정규편성" => "regular",
            "N-VOD편성" => "vod"
        ][$channelBroadcast] ?? null;
    }

    /**
     * @param string|null $channelCode
     * @return string|null
     */
    public static function mapChannelName(?string $channelCode = null): ?string
    {
        return [
            "11" => "kbs 1 tv",
            "12" => "kbs 2 tv",
            "21" => "kbs 1 radio",
            "22" => "kbs 2 radio"
        ][$channelCode] ?? null;
    }

    /**
     * @param string|null $channelType
     * @return string|null
     */
    public static function mapChannelType(?string $channelType = null): ?string
    {
        return [
            "RADIO" => "radio",
            "TV"    => "tv"
        ][$channelType] ?? null;
    }

    /**
     * @param string|null $programBroadcast
     * @return string|null
     */
    public static function mapProgramBroadcast(?string $programBroadcast = null): ?string
    {
        return [
            "생방" => "live",
            "녹화" => "recording",
            "녹음" => "recording"
        ][$programBroadcast] ?? null;
    }

    /**
     * @param string|null $scheduleBroadcast
     * @return string|null
     */
    public static function mapScheduleBroadcast(?string $scheduleBroadcast = null): ?string
    {
        return [
            "본방" => "original",
            "재방" => "rerun"
        ][$scheduleBroadcast] ?? null;
    }
}
