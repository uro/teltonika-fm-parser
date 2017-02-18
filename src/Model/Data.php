<?php

declare(strict_types = 1);

namespace Uro\TeltonikaFmParser\Model;

use DateTimeImmutable;
use JsonSerializable;

class Data implements Model, JsonSerializable
{
    /**
     * @var DateTimeImmutable
     */
    private $dateTime;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var GpsData
     */
    private $gpsData;

    /**
     * @var SensorsData
     */
    private $sensorsData;

    public function __construct(
        DateTimeImmutable $dateTime,
        GpsData $gpsData,
        SensorsData $sensorsData,
        int $priority
    )
    {
        $this->dateTime = $dateTime;
        $this->priority = $priority;
        $this->gpsData = $gpsData;
        $this->sensorsData = $sensorsData;
    }

    public function getDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getGpsData(): GpsData
    {
        return $this->gpsData;
    }

    public function getSensorsData(): SensorsData
    {
        return $this->sensorsData;
    }

    public function jsonSerialize(): array
    {
        return [
            'dateTime' => $this->getDateTime(),
            'priority' => $this->getPriority(),
            'gpsData' => $this->getGpsData()
        ];
    }

    public static function createFromHex(string $payload, int &$position): Data
    {
        $timestamp = hexdec(substr($payload, $position, 16)) / 1000;

        $dateTime = new DateTimeImmutable();
        $dateTime = $dateTime->setTimestamp(intval($timestamp)); // Timestamp needs to be a float because its containing milliseconds

        $position += 16;

        $priority = (int)hexdec(substr($payload, $position, 2));
        $position += 2;

        $gpsData = GpsData::createFromHex($payload, $position);

        $sensorsData = SensorsData::createFromHex($payload, $position);

        return new Data($dateTime, $gpsData, $sensorsData, $priority);
    }
}
