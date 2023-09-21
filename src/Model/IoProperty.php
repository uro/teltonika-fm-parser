<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

class IoProperty extends Model
{
    public function __construct(private readonly int $id, private readonly IoValue $value)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): IoValue
    {
        return $this->value;
    }
}
