<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

class AvlDataCollection extends Model
{
    private array $avlData;

    public function __construct(private readonly int $codecId, private readonly int $numberOfData)
    {
    }

    public function getCodecId(): int
    {
        return $this->codecId;
    }

    public function getNumberOfData(): int
    {
        return $this->numberOfData;
    }

    public function getAvlData(): array
    {
        return $this->avlData;
    }

    public function setAvlData(array $avlData): AvlDataCollection
    {
        $this->avlData = $avlData;

        return $this;
    }
}
