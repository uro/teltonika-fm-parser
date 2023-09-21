<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Codec;

use Uro\TeltonikaFmParser\Model\IoElement;
use Uro\TeltonikaFmParser\Model\IoProperty;
use Uro\TeltonikaFmParser\Model\IoValue;

class Codec8Extended extends BaseCodec
{
    public function decodeIoElement(): IoElement
    {
        return (new IoElement(
            (int)$this->reader->readUInt16(),    // Event ID
            (int)$this->reader->readUInt16()     // Number of elements
        ))->addProperties($this->decodeIoProperties());
    }

    private function decodeIoProperties(): array
    {
        $properties = [];
        for ($bytes = 1; $bytes <= 8; $bytes *= 2) {
            $numberOfProperties = $this->reader->readUInt16();
            for ($i = 0; $i < $numberOfProperties; $i++) {
                $properties[] = new IoProperty(
                    (int)$this->reader->readUInt16(),
                    new IoValue((string)$this->reader->readBytes($bytes))
                );
            }
        }

        return array_merge($properties, $this->decodeVariableLengthProperties());
    }

    /**
     * @return IoProperty[]
     */
    private function decodeVariableLengthProperties(): array
    {
        $properties = [];

        $numberOfProperties = $this->reader->readUInt16();
        for ($i = 0; $i < $numberOfProperties; $i++) {
            $id = (int)$this->reader->readUInt16();
            $length = (int)$this->reader->readUInt16();
            if ($length === 0) {
                $value = new IoValue('');
            } else {
                $value = new IoValue((string)$this->reader->readBytes($length));
            }
            $properties[] = new IoProperty($id, $value);
        }

        return $properties;
    }
}
