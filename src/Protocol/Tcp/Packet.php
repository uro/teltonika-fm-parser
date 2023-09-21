<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

use Uro\TeltonikaFmParser\Model\AvlDataCollection;
use Uro\TeltonikaFmParser\Support\Acknowledgeable;
use Uro\TeltonikaFmParser\Support\Crc16;

class Packet implements Acknowledgeable
{
    public function __construct(
        private readonly int $preamble,
        private readonly int $avlDataArrayLength,
        private readonly AvlDataCollection $avlDataCollection,
        private readonly int $crc
    ) {
    }

    public function getPreamble(): int
    {
        return $this->preamble;
    }

    public function getAvlDataArrayLength(): int
    {
        return $this->avlDataArrayLength;
    }

    public function getAvlDataCollection(): AvlDataCollection
    {
        return $this->avlDataCollection;
    }

    public function getNumberOfAcceptedData(): int
    {
        return $this->avlDataCollection->getNumberOfData();
    }

    public function getCrc(): int
    {
        return $this->crc;
    }

    public function checkCrc(string $input): bool
    {
        return $this->crc == (new Crc16())->calculate($input);
    }
}
