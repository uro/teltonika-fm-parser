<?php 

namespace Uro\TeltonikaFmParser\Model;

class AvlData extends Model
{
    /**
     * Timestamp in milliseconds
     *
     * @var integer
     */
    private $timestamp;

    /**
     * Priority
     *
     * @var integer
     */
    private $priotiry;

    /**
     * Gps Element
     *
     * @var GpsElement
     */
    private $gpsElement;

    /**
     * IO Element
     *
     * @var IoElement
     */
    private $ioElement;

    public function __construct($timestamp, $priority, $gpsElement, $ioElement)
    {
        $this->timestamp = $timestamp;
        $this->priotiry = $priority;
        $this->gpsElement = $gpsElement;
        $this->ioElement = $ioElement;
    }

    /**
     * Get timestamp
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priotiry;
    }

    /**
     * Get GPS Element
     *
     * @return GpsElement
     */
    public function getGpsElement()
    {
        return $this->gpsElement;
    }

    /**
     * Get IO Element
     *
     * @return IoElement
     */
    public function getIoElement()
    {
        return $this->ioElement;
    }
}