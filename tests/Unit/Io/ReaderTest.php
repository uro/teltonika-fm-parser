<?php 

namespace Tests\Unit\Io;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Io\Reader;

class ReaderTest extends TestCase
{
    /** @test */
    public function can_read_hexadecimal_input()
    {
        $this->assertEquals(15, (new Reader('0f'))->readUInt8());
    }

    /** @test */
    public function can_read_binary_input()
    {
        $this->assertEquals(15, (new Reader(hex2bin('0f')))->readUInt8());
    }
}