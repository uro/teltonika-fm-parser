<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

use Uro\TeltonikaFmParser\Codec\BaseCodec;
use Uro\TeltonikaFmParser\Codec\Codec8;
use Uro\TeltonikaFmParser\Codec\Codec8Extended;
use Uro\TeltonikaFmParser\DecoderInterface;
use Uro\TeltonikaFmParser\Exception\CrcMismatchException;
use Uro\TeltonikaFmParser\Exception\InvalidArgumentException;
use Uro\TeltonikaFmParser\Exception\NumberOfDataMismatchException;
use Uro\TeltonikaFmParser\Exception\UnsupportedCodecException;
use Uro\TeltonikaFmParser\Io\Reader;
use Uro\TeltonikaFmParser\Model\Imei;

class Decoder implements DecoderInterface
{
    private Reader $reader;

    /**
     * @var string[]
     */
    private array $codecs = [
        0x08 => Codec8::class,
        0x8E => Codec8Extended::class,
    ];

    /**
     * @throws InvalidArgumentException
     */
    public function decodeImei(string $payload): Imei
    {
        $this->reader = new Reader($payload);
        $numberOfBytes = (int)$this->reader->readUInt16();

        return new Imei((string)$this->reader->readBytes($numberOfBytes));
    }

    /**
     * @throws UnsupportedCodecException|NumberOfDataMismatchException|CrcMismatchException
     */
    public function decodeData(string $payload): Packet
    {
        $this->reader = new Reader($payload);

        $packet = new Packet(
            $this->reader->readUInt32(),                // Preamble
            $this->reader->readUInt32(),                // Avl Data array length
            $this->codec()->decodeAvlDataCollection(),  // Avl Data collection
            $this->reader->readUInt32()                 // CRC
        );

        if (!$packet->checkCrc($this->crcInput())) {
            throw new CrcMismatchException();
        }

        return $packet;
    }

    /**
     * @throws CrcMismatchException
     */
    private function crcInput(): string
    {
        $this->reader->setPosition(0);
        $packetString = bin2hex($this->reader->getInputString());
        $crcInput = substr(
            $packetString,
            16,
            strlen($packetString) - 24
        );

        $result = hex2bin($crcInput);
        if ($result === false) {
            throw new CrcMismatchException();
        }

        return $result;
    }

    /**
     * @throws UnsupportedCodecException
     */
    private function codec(): BaseCodec
    {
        $position = $this->reader->getPosition();
        $codecId = $this->reader->readUInt8();

        if (!array_key_exists($codecId, $this->codecs)) {
            throw new UnsupportedCodecException((int) $codecId);
        }

        /** @var BaseCodec $codec */
        $codec = new $this->codecs[$codecId]($this->reader);

        $this->reader->setPosition($position);

        return $codec;
    }
}
