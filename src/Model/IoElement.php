<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

class IoElement extends Model
{
    /**
     * @var IoProperty[]
     */
    private array $properties;

    public function __construct(private readonly int $eventId, private readonly int $numberOfElements)
    {
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function getNumberOfElements(): int
    {
        return $this->numberOfElements;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getPropertyById(int $id): ?IoProperty
    {
        return $this->properties[$id];
    }

    /**
     * @param IoProperty[] $properties
     */
    public function addProperties(array $properties): IoElement
    {
        foreach ($properties as $property) {
            $this->addProperty($property);
        }

        return $this;
    }

    public function addProperty(IoProperty $property): IoElement
    {
        $this->properties[$property->getId()] = $property;

        return $this;
    }
}
