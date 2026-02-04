<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

class IoElement extends Model
{
    /**
     * @var IoProperty[]
     */
    private array $properties = [];

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

    public function hasPropertyById(int $id): bool
    {
        return array_key_exists($id, $this->properties);
    }

    public function getPropertyById(int $id): ?IoProperty
    {
        return $this->hasPropertyById($id) ? $this->properties[$id] : null;
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
