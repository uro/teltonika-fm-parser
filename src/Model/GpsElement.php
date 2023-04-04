<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

class GpsElement extends Model
{
    public function __construct(
        private readonly float $longitude,
        private readonly float $latitude,
        private readonly int $altitude,
        private readonly int $angle,
        private readonly int $satellites,
        private readonly int $speed
    ) {
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
}
