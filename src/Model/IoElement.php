<?php 

namespace Uro\TeltonikaFmParser\Model;

class IoElement extends Model
{
    /**
     * ID of event generated. 0 if data generated not on event
     *
     * @var int
     */
    private $eventId;

    /**
     * Number of IO properties in record
     *
     * @var int
     */
    private $numberOfElements;

    /**
     * IO properties in record
     *
     * @var array
     */
    private $properties;

    public function __construct(int $eventId, int $numberOfElements)
    {
        $this->eventId = $eventId;
        $this->numberOfElements = $numberOfElements;
    }

    /**
     * Get event ID
     *
     * @return int
     */
    public function getEventId(): int
    {
        return $this->eventId;
    }

    /**
     * Get number of elements
     *
     * @return int
     */
    public function getNumberOfElements(): int
    {
        return $this->numberOfElements;
    }

    /**
     * Get properties
     *
     * @return array
     */
    public function getProperties(): array 
    {
        return $this->properties;
    }

    /**
     * Get IO property by ID
     *
     * @param integer $id
     * @param mixed $default
     * @return IoProperty
     */
    public function getPropertyById($id, $default = null)
    {
        return $this->properties[$id] ?? $default;
    }

    /**
     * Add properties to element
     *
     * @param array $properties
     * @return void
     */
    public function addProperties(array $properties): IoElement
    {
        foreach($properties as $property) {
            $this->properties[$property->getId()] = $property;
        }

        return $this;
    }
}