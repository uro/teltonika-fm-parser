<?php 

namespace Tests\Unit\Codec;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Io\Reader;
use Uro\TeltonikaFmParser\Codec\Codec8Extended;
use Uro\TeltonikaFmParser\Support\Testing\TestAvlData;
use Uro\TeltonikaFmParser\Support\Testing\Test15BytesGpsElement;

class Codec8ExtendedTest extends TestCase 
{
    use Test15BytesGpsElement, TestAvlData;

    protected function codecClass()
    {
        return Codec8Extended::class;
    }

    /** @test */
    public function can_decode_io_element()
    {
        $reader = new Reader($this->validIoElement());

        $ioElement = (new Codec8Extended($reader))->decodeIoElement();

        $this->assertIoElement($ioElement);
    }

    private function assertIoElement($ioElement)
    {
        $this->assertNotNull($ioElement);
        $this->assertEquals(0, $ioElement->getEventId());
        $this->assertEquals(6, $ioElement->getNumberOfElements());
        $this->assertEquals('0f', $ioElement->getPropertyById(239)->getValue()->toHex());
        $this->assertEquals('001e', $ioElement->getPropertyById(17)->getValue()->toHex());
        $this->assertEquals('0000cbdf', $ioElement->getPropertyById(16)->getValue()->toHex());
        $this->assertEquals('000000003544c875', $ioElement->getPropertyById(11)->getValue()->toHex());
        $this->assertEquals('0000000029bfe4d1', $ioElement->getPropertyById(14)->getValue()->toHex());
        $this->assertEquals('f00000000000000000000000000000001a', $ioElement->getPropertyById(256)->getValue()->toHex());
    }

    private function validIoElement()
    {
        return
            '0000'.                                 // IO element ID of Event generated
            '0006'.                                 // 6 IO elements in record (total)
            '0001'.                                 // 1 IO elements which length is 1 byte
            '00EF'.                                 // IO element ID 239
            '0F'.                                   // IO element value 15
            '0001'.                                 // 1 IO elements which length is 2 byte
            '0011'.                                 // IO element ID 17 
            '001E'.                                 // IO element value 
            '0001'.                                 // 1 IO elements which length is 4 Byte
            '0010'.                                 // IO element ID 16
            '0000CBDF'.                             // IO element value
            '0002'.                                 // 2 IO elements, which length is 8 Byte
            '000B'.                                 // IO element ID 11
            '000000003544C875'.                     // IO element value
            '000E'.                                 // IO element ID 14
            '0000000029BFE4D1'.                     // IO element value
            '0001'.                                 // 1 IO elements witch length is variable
            '0100'.                                 // IO element ID 256
            '0011'.                                 // IO element length 17
            'F00000000000000000000000000000001A';   // Variable length element value
    }
}