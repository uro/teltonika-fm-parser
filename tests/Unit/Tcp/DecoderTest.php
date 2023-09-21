<?php

namespace Tests\Unit\Protocol\Tcp;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Exception\InvalidArgumentException;
use Uro\TeltonikaFmParser\Exception\NumberOfDataMismatchException;
use Uro\TeltonikaFmParser\Exception\UnsupportedCodecException;
use Uro\TeltonikaFmParser\Protocol\Tcp\Decoder;
use Uro\TeltonikaFmParser\Exception\CrcMismatchException;

class DecoderTest extends TestCase
{
    /**
     * @test
     * @throws InvalidArgumentException
     */
    public function can_decode_imei()
    {
        $imei = (new Decoder())->decodeImei('000F383632323539353838383334323930');

        $this->assertNotNull($imei);
        $this->assertEquals('862259588834290', $imei->getImei());
    }

    /**
     * @test
     * @throws NumberOfDataMismatchException
     * @throws UnsupportedCodecException
     * @throws CrcMismatchException
     */
    public function can_decode_codec8_data()
    {
        $packet = (new Decoder())->decodeData(
            '0000000000000003'.     // AVL Packet header
            '08'.                   // Codec 8 ID
            '0000'.                 // Empty AVL collection
            '0000c281'              // CRC
        );

        $this->assertNotNull($packet);
        $this->assertEquals(0, $packet->getPreamble());
        $this->assertEquals(3, $packet->getAvlDataArrayLength());
        $this->assertEquals(0x08, $packet->getAvlDataCollection()->getCodecId());
        $this->assertEquals(0x0000c281, $packet->getCrc());
    }

    /**
     * @test
     * @throws NumberOfDataMismatchException
     * @throws UnsupportedCodecException
     * @throws CrcMismatchException
     */
    public function can_decode_codec8extended_data(): void
    {
        $packet = (new Decoder())->decodeData(
            '0000000000000003'.     // AVL Packet header
            '8E'.                   // Codec 8 ID
            '0000'.                 // Empty AVL collection
            '00002b60'              // CRC
        );

        $this->assertNotNull($packet);
        $this->assertEquals(0, $packet->getPreamble());
        $this->assertEquals(3, $packet->getAvlDataArrayLength());
        $this->assertEquals(0x8E, $packet->getAvlDataCollection()->getCodecId());
        $this->assertEquals(0x00002b60, $packet->getCrc());
    }

    /**
     * @test
     * @throws NumberOfDataMismatchException
     * @throws CrcMismatchException
     */
    public function unsupported_codec_throw_exception(): void
    {
        $this->expectException(UnsupportedCodecException::class);

        (new Decoder())->decodeData(
            '0000000000000003'.     // AVL Packet header
            'FF'.                   // Unsupported Codec ID
            '0000'.                 // Empty AVL collection
            '00008612'              // CRC
        );
    }
}
