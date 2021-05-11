<?php 

namespace Uro\TeltonikaFmParser\Codec;

use Uro\TeltonikaFmParser\Model\IoValue;
use Uro\TeltonikaFmParser\Model\IoElement;
use Uro\TeltonikaFmParser\Model\IoProperty;

class Codec8Extended extends BaseCodec 
{
    public function decodeIoElement(): IoElement
    {
        return (new IoElement(
            $this->reader->readUInt16(),    // Event ID
            $this->reader->readUInt16()     // Number of elements
        ))->addProperties($this->decodeIoProperties());
    }

    private function decodeIoProperties(): array
    {
        $properties = [];
        for($bytes = 1; $bytes <= 8; $bytes *= 2) {
            $numberOfProperties = $this->reader->readUInt16();
            for($i = 0; $i < $numberOfProperties; $i++) {
                $properties[] = new IoProperty(
                    $this->reader->readUInt16(),
                    new IoValue($this->reader->readBytes($bytes))
                );
            }
        }

        return array_merge($properties, $this->decodeVariableLengthProperties());
    }

    private function decodeVariableLengthProperties()
    {
        $properties = [];

        $numberOfProperties = $this->reader->readUInt16();
        for($i = 0; $i < $numberOfProperties; $i++) {
            $properties[] = new IoProperty(
                $this->reader->readUInt16(),
                new IoValue($this->reader->readBytes($this->reader->readUInt16()))
            );
        }

        return $properties;
    }
}