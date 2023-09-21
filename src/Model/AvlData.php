<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

class AvlData extends Model
{
    public function __construct(
        private readonly int $timestamp,
        private readonly int $priority,
        private readonly GpsElement $gpsElement,
        private readonly IoElement $ioElement
    ) {
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getGpsElement(): GpsElement
    {
        return $this->gpsElement;
    }

    public function getIoElement(): IoElement
    {
        return $this->ioElement;
    }
}
