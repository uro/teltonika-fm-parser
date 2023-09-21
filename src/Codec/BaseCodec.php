<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Codec;

use Uro\TeltonikaFmParser\Exception\NumberOfDataMismatchException;
use Uro\TeltonikaFmParser\Io\Reader;
use Uro\TeltonikaFmParser\Model\AvlData;
use Uro\TeltonikaFmParser\Model\AvlDataCollection;
use Uro\TeltonikaFmParser\Model\GpsElement;

abstract class BaseCodec implements Codec
{
    public function __construct(protected readonly Reader $reader)
    {
    }

    /**
     * @throws NumberOfDataMismatchException
     */
    public function decodeAvlDataCollection(): AvlDataCollection
    {
        $avlDataCollection = new AvlDataCollection(
            $this->reader->readUInt8(),     // Codec ID
            $this->reader->readUInt8()      // Number of data
        );

        $avlData = [];
        for ($i = 0; $i < $avlDataCollection->getNumberOfData(); $i++) {
            $avlData[] = $this->decodeAvlData();
        }
        $avlDataCollection->setAvlData($avlData);

        $this->checkNumberOfData($avlDataCollection->getNumberOfData());

        return $avlDataCollection;
    }

    /**
     * @throws NumberOfDataMismatchException
     */
    private function checkNumberOfData(int $expected): void
    {
        $lastNumberOfData = $this->reader->readUInt8();
        if ($expected !== $lastNumberOfData) {
            throw new NumberOfDataMismatchException(
                $expected,
                $lastNumberOfData
            );
        }
    }

    public function decodeAvlData(): AvlData
    {
        return new AvlData(
            (int)$this->reader->readUInt64(),    // Timestamp
            (int)$this->reader->readUInt8(),     // Priority
            $this->decodeGpsElement(),      // GPS Element
            $this->decodeIoElement()        // IO Element
        );
    }

    public function decodeGpsElement(): GpsElement
    {
        return new GpsElement(
            $this->decodeCoordinate(),      // Longitude
            $this->decodeCoordinate(),      // Latitude
            (int)$this->reader->readUInt16(),    // Altitude
            (int)$this->reader->readUInt16(),    // Angle
            (int)$this->reader->readUInt8(),     // Satellites
            (int)$this->reader->readUInt16()     // Speed
        );
    }

    protected function decodeCoordinate(): float
    {
        $raw = (array)unpack('l', pack('l', $this->reader->readUInt32()));

        return $raw[1] / 10000000;
    }
}
