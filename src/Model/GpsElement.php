<?php 

namespace Uro\TeltonikaFmParser\Model;

class GpsElement extends Model
{
    /**
     * Decimal Longitude
     *
     * @var float
     */
    private $longitude;

    /**
     * Decimal Latitude
     *
     * @var float
     */
    private $latitude;

    /**
     * Altitude in meters
     *
     * @var int
     */
    private $altitude;

    /**
     * Angle
     *
     * @var int
     */
    private $angle;

    /**
     * Number of satellites
     *
     * @var int
     */
    private $satellites;

    /**
     * Speed in Km/h
     *
     * @var int
     */
    private $speed;

    public function __construct(
        $longitude, 
        $latitude,
        $altitude,
        $angle,
        $satellites,
        $speed
        )
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->altitude = $altitude;
        $this->angle = $angle;
        $this->satellites = $satellites;
        $this->speed = $speed;
    }

    /**
     * Get Longitude
     *
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * Get Latitude
     *
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Get Altitude
     *
     * @return int
     */
    public function getAltitude(): int 
    {
        return $this->altitude;
    }

    /**
     * Get angle
     *
     * @return int
     */
    public function getAngle(): int 
    {
        return $this->angle;
    }

    /**
     * Get Number of satellites
     *
     * @return integer
     */
    public function getSatellites(): int 
    {
        return $this->satellites;
    }

    /**
     * Get Speed
     *
     * @return int
     */
    public function getSpeed(): int 
    {
        return $this->speed;
    }
}