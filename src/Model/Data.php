<?php

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
     * @var string
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
        string $priority
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

    public function getPriority(): string
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
        $timestamp = hexdec(substr($payload, $position, 16));

        $dateTime = new DateTimeImmutable();
        $dateTime = $dateTime->setTimestamp($timestamp / 1000); // Timestamp needs to be a float because its containing milliseconds

        $position += 16;

        $priority = hexdec(substr($payload, $position, 2));
        $position += 2;

        $gpsData = GpsData::createFromHex($payload, $position);

        $sensorsData = SensorsData::createFromHex($payload, $position);

        return new Data($dateTime, $gpsData, $sensorsData, $priority);
    }
}
