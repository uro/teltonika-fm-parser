<?php 

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

use Uro\TeltonikaFmParser\Io\Reader;
use Uro\TeltonikaFmParser\Codec\Codec8;
use Uro\TeltonikaFmParser\Codec\Codec8Extended;
use Uro\TeltonikaFmParser\Exception\UnsupportedCodecException;
use Uro\TeltonikaFmParser\Model\Imei;

class Decoder 
{
    private $reader;

    protected $codecs = [
        0x08 => Codec8::class,
        0x8E => Codec8Extended::class,
    ];

    public function decodeImei($data)
    {
        $this->reader = new Reader($data);

        $numberOfBytes = $this->reader->readUInt16();

        return new Imei($this->reader->readBytes($numberOfBytes));
    }

    public function decodeData($data)
    {
        $this->reader = new Reader($data);

        return new Packet(
            $this->reader->readUInt32(),                // Preamble
            $this->reader->readUInt32(),                // Avl Data array length
            $this->codec()->decodeAvlDataCollection(),  // Avl Data collection
            $this->reader->readUInt32()                 // CRC
        );
    }

    private function codec()
    {
        $position = $this->reader->getPosition();
        $codecId = $this->reader->readUInt8();

        if(! array_key_exists($codecId, $this->codecs)) {
            throw new UnsupportedCodecException($codecId);
        }

        $codec = new $this->codecs[$codecId]($this->reader);

        $this->reader->setPosition($position);

        return $codec;
    }
}