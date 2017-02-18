<?php

namespace Uro\TeltonikaFmParser\Model;

use DateTimeImmutable;

class Data
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
    private $gpsElement;

    /**
     * @var SensorsData
     */
    private $sensorsData;

    public function __construct(
        DateTimeImmutable $dateTime,
        GpsData $gpsElement,
        SensorsData $sensorsData,
        string $priority
    )
    {
        $this->dateTime= $dateTime;
        $this->priority = $priority;
        $this->gpsElement = $gpsElement;
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
        return $this->gpsElement;
    }

    public function getSensorsData(): SensorsData
    {
        return $this->sensorsData;
    }

    public static function createFromHex(string $payload, int &$position): Data
    {
        $timestamp = hexdec(substr($payload, $position, 16));

        $dateTime = new DateTimeImmutable();
        $dateTime->setTimestamp($timestamp / 1000); // Timestamp needs to be a float because its containing milliseconds

        $position += 16;

        $priority = hexdec(substr($payload, $position, 2));
        $position += 2;

        $gpsElement = GpsData::createFromHex($payload, $position);

        $sensorsData = SensorsData::createFromHex($payload, $position);

        return new Data($dateTime, $gpsElement, $sensorsData, $priority);
    }
}
