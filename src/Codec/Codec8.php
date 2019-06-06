<?php 

namespace Uro\TeltonikaFmParser\Codec;

use Uro\TeltonikaFmParser\Model\IoValue;
use Uro\TeltonikaFmParser\Codec\BaseCodec;
use Uro\TeltonikaFmParser\Model\IoElement;
use Uro\TeltonikaFmParser\Model\IoProperty;

class Codec8 extends BaseCodec
{
    public function decodeIoElement(): IoElement
    {
        return (new IoElement(
            $this->reader->readUInt8(),     // Event ID
            $this->reader->readUInt8()      // Number of elements
        ))->addProperties($this->decodeIoProperties());
    }

    private function decodeIoProperties()
    {
        $properties = [];
        for($bytes = 1; $bytes <= 8; $bytes *= 2) {
            $numberOfProperties = $this->reader->readUInt8();
            for($i = 1; $i <= $numberOfProperties; $i++) {
                $properties[] = new IoProperty(
                    $this->reader->readUInt8(),
                    new IoValue($this->reader->readBytes($bytes))
                );
            }
        }

        return $properties;
    }
}