<?php

namespace Tests\Unit;

use Uro\TeltonikaFmParser\TcpEncoder;

class TcpEncoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TcpEncoder
     */
    private $tcpEncoder;

    protected function setUp()
    {
        parent::setUp();

        $this->tcpEncoder = new TcpEncoder();
    }

    /** @test */
    public function is_encoding_auth_properly()
    {
        $hexResponseTrue = $this->tcpEncoder->encodeAuthentication(true);
        $hexResponseFalse = $this->tcpEncoder->encodeAuthentication(false);

        $this->assertEquals('01', $hexResponseTrue);
        $this->assertEquals('00', $hexResponseFalse);
    }

    /** @test */
    public function is_encoding_data_response_properly()
    {
        $numOfElements1 = 2;
        $numOfElements2 = 77;

        $hexResponse1 = $this->tcpEncoder->encodeData($numOfElements1);
        $hexResponse2 = $this->tcpEncoder->encodeData($numOfElements2);

        $this->assertEquals('00000002', $hexResponse1);
        $this->assertEquals('4d', $hexResponse2);
    }

    /**
     * @test
     *
     * @expectedException \Uro\TeltonikaFmParser\Exception\InvalidArgumentException
     * @expectedExceptionMessage Value must be 0 or more
     */
    public function is_throwing_an_exception_if_number_of_rows_is_less_than_0()
    {
        $numOfElements = -7;

        $this->tcpEncoder->encodeData($numOfElements);
    }
}
