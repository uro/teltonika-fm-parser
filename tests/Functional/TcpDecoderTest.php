<?php

namespace tests\Unit;

use PHPUnit_Framework_TestCase;
use Uro\TeltonikaFmParser\Decoder;
use Uro\TeltonikaFmParser\Model\Imei;
use Uro\TeltonikaFmParser\TcpDecoder;

class TcpDecoderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Decoder
     */
    private $decoder;

    public function setUp()
    {
        $this->decoder = new TcpDecoder();
    }

    /** @test */
    public function is_recognizing_authentication_payload()
    {
        $imeiPayload = "000F313233343536373839303132333435";
        $payloadWithData = "00000000000000FE080400000113fc208dff00";

        $this->assertTrue($this->decoder->isAuthentication($imeiPayload));
        $this->assertFalse($this->decoder->isAuthentication($payloadWithData));
    }

    /** @test */
    public function is_decoding_authentication_payload()
    {
        $payload = "000F383632323539353838383334323930";
        $imei = $this->decoder->decode($payload);

        $this->assertEquals(Imei::class, get_class($imei));
        $this->assertEquals('862259588834290', $imei->getImei());
    }

    /** @test */
    public function its_decoding_gps_data()
    {
        $payload = "00000000000000FE080400000113fc208dff000f14f650209cca80006f00d60400040004030101150316030001460000015d0000000113fc17610b000f14ffe0209cc580006e00c00500010004030101150316010001460000015e0000000113fc284945000f150f00209cd200009501080400000004030101150016030001460000015d0000000113fc267c5b000f150a50209cccc0009300680400000004030101150016030001460000015b000400008612";

        $this->decoder->decode($payload);
    }

    public function its_decoding_io_element()
    {

    }
}
