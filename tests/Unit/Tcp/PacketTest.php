<?php 

namespace Tests\Unit\Protocol\Tcp;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Protocol\Tcp\Packet;
use Uro\TeltonikaFmParser\Model\AvlDataCollection;

class PacketTest extends TestCase
{
    private $packet;

    private $avlDataCollection;

    public function setUp()
    {
        $this->avlDataCollection = new AvlDataCollection(8, 2, []);
        $this->packet = new Packet(0, 2, $this->avlDataCollection, 0x2b60);
    }

    /** @test */
    public function can_get_number_of_accepted_data()
    {
        $this->assertEquals(2, $this->packet->getNumberOfAcceptedData());
    }

    /** @test */
    public function can_get_preamble()
    {
        $this->assertEquals(0, $this->packet->getPreamble());
    }

    /** @test */
    public function can_get_avl_data_array_length()
    {
        $this->assertEquals(2, $this->packet->getAvlDataArrayLength());
    }

    /** @test */
    public function can_get_avl_data_collection()
    {
        $this->assertEquals($this->avlDataCollection, $this->packet->getAvlDataCollection());
    }

    /** @test */
    public function can_get_crc()
    {
        $this->assertEquals(0x2b60, $this->packet->getCrc());
    }

    /** @test */
    public function can_check_crc_valid_data()
    {
        $this->assertTrue($this->packet->checkCrc(hex2bin('8e0000')));
    }

    /** @test */
    public function can_check_crc_invalid_data()
    {
        $this->assertFalse($this->packet->checkCrc(hex2bin('8f0000')));
    }
}