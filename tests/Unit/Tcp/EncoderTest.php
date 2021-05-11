<?php 

namespace Tests\Unit\Protocol\Tcp;

use Mockery;
use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Support\Acknowledgeable;
use Uro\TeltonikaFmParser\Protocol\Tcp\Encoder;

class EncoderTest extends TestCase
{
    /** @test */
    public function can_encode_acknowledge()
    {
        $packet = Mockery::mock(Acknowledgeable::class)
                    ->shouldReceive('getNumberOfAcceptedData')
                    ->andReturns(2)->getMock();

        $ack = (new Encoder)->encodeAcknowledge($packet);

        $this->assertNotNull($ack);
        $this->assertEquals(4, strlen($ack));
        $this->assertEquals(00000002, bin2hex($ack));
    }
}