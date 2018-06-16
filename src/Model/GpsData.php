<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

use JsonSerializable;

class GpsData implements JsonSerializable
{
    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var int
     */
    private $altitude;

    /**
     * @var int
     */
    private $angle;

    /**
     * @var int
     */
    private $satellites;

    /**
     * @var int
     */
    private $speed;

    public function __construct(
        float $longitude,
        float $latitude,
        int $altitude,
        int $angle,
        int $satellites,
        int $speed
    )
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->altitude = $altitude;
        $this->angle = $angle;
        $this->satellites = $satellites;
        $this->speed = $speed;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getAltitude(): int
    {
        return $this->altitude;
    }

    public function getAngle(): int
    {
        return $this->angle;
    }

    public function getSatellites(): int
    {
        return $this->satellites;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * If there were no GPS fix in the moment of data acquisition – Angle, Satellites and Speed are 0.
     *
     * @return bool
     */
    public function hasGpsFix(): bool
    {
        return !((($this->angle === $this->speed) === $this->satellites) && ($this->satellites == 0));
    }

    public static function createFromHex(string $payload, int &$position): GpsData
    {
        $longitude = hexdec(substr($payload, $position, 8));
        $longitude = (float)(($longitude & 0x7fffffff) / 10000000) * (($longitude >> 31) == 1 ? -1 : 1);
        $position += 8;

        $latitude = hexdec(substr($payload, $position, 8));
        $latitude = (float)(($latitude & 0x7fffffff) / 10000000) * (($latitude >> 31) == 1 ? -1 : 1);
        $position += 8;

        $altitude = (int)hexdec(substr($payload, $position, 4));
        $position += 4;

        $angle = (int)hexdec(substr($payload, $position, 4));
        $position += 4;

        $satellites = (int)hexdec(substr($payload, $position, 2));
        $position += 2;

        $speed = (int)hexdec(substr($payload, $position, 4));

        return new GpsData($longitude, $latitude, $altitude, $angle, $satellites, $speed);
    }

    public function jsonSerialize(): array
    {
        return [
            'longitude' => $this->getLongitude(),
            'latitude' => $this->getLatitude(),
            'altitude' => $this->getAltitude(),
            'angle' => $this->getAngle(),
            'satellites' => $this->getSatellites(),
            'speed' => $this->getSpeed(),
            'hasGpsFix' => $this->hasGpsFix()
        ];
    }
}
