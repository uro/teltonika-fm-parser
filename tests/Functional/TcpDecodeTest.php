<?php 

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\FmParser;

class TcpDecodeTest extends TestCase 
{
    /** @test */
    public function can_decode_imei()
    {
        $imei = (new FmParser('tcp'))->decodeImei('000F383632323539353838383334323930');

        $this->assertEquals('862259588834290', $imei->getImei());
    }

    /** @test */
    public function can_decode_data()
    {
        $packet = (new FmParser('tcp'))->decodeData(
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
     * @expectedException Uro\TeltonikaFmParser\Exception\CrcMismatchException
     */
    public function invalid_crc_throws_crc_mismatch_exception()
    {
        (new FmParser('tcp'))->decodeData(
            '0000000000000003'.     // AVL Packet header
            '8E'.                   // Codec 8 ID
            '0000'.                 // Empty AVL collection
            '00002b61'              // CRC
        );
    }
}