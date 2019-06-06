<?php 

namespace Tests\Unit\Codec;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Io\Reader;
use Uro\TeltonikaFmParser\Codec\Codec8;
use Uro\TeltonikaFmParser\Support\Testing\TestAvlData;
use Uro\TeltonikaFmParser\Support\Testing\Test15BytesGpsElement;

class Codec8Test extends TestCase
{
    use Test15BytesGpsElement, TestAvlData;

    protected function codecClass()
    {
        return Codec8::class;
    }

    /** @test */
    public function can_decode_io_element()
    {
        $reader = new Reader($this->validIoElement());

        $ioElement = (new Codec8($reader))->decodeIoElement();

        $this->assertIoElement($ioElement);
    }

    private function assertIoElement($ioElement)
    {
        $this->assertNotNull($ioElement);
        $this->assertEquals(0, $ioElement->getEventId());
        $this->assertEquals(4, $ioElement->getNumberOfElements());
        $this->assertEquals(1, $ioElement->getPropertyById(1)->getValue()->toUnsigned());
        $this->assertEquals(3, $ioElement->getPropertyById(21)->getValue()->toUnsigned());
        $this->assertEquals(3, $ioElement->getPropertyById(22)->getValue()->toUnsigned());
        $this->assertEquals(349, $ioElement->getPropertyById(70)->getValue()->toUnsigned());
    }

    private function validIoElement()
    {
        return 
            '00'.                           // IO element ID of Event generated (in this case when 00 – data generated not on event)
            '04'.                           // 4 IO elements in record
            '03'.                           // 3 IO elements, which length is 1 Byte
            '01'.                           // IO element ID = 01
            '01'.                           // 1’st IO element’s value = 1
            '15'.                           // IO element ID = 21
            '03'.                           // 21’st IO element’s value = 3
            '16'.                           // IO element ID = 22
            '03'.                           // 22’nd IO element’s value = 3
            '00'.                           // 0 IO elements, which value length is 2 Bytes
            '01'.                           // 1 IO element, which value length is 4 Bytes
            '46'.                           // IO element ID = 70
            '0000015d'.                     // 70’th IO element’s value = 349
            '00';                           // 0 IO elements, which value length is 8 Bytes

    }
}