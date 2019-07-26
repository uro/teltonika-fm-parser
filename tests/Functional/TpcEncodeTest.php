<?php 

namespace Tests\Functional;

use Mockery;
use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\FmParser;
use Uro\TeltonikaFmParser\Support\Acknowledgeable;

class TcpEncodeTest extends TestCase 
{
    /** @test */
    public function can_encode_tcp_acknowledge()
    {
        $packet = Mockery::mock(Acknowledgeable::class)
                    ->shouldReceive('getNumberOfAcceptedData')
                    ->andReturns(2)->getMock();

        $ack = (new FmParser('tcp'))->encodeAcknowledge($packet);

        $this->assertNotNull($ack);
        $this->assertEquals(4, strlen($ack));
        $this->assertEquals(00000002, bin2hex($ack));
    }
}