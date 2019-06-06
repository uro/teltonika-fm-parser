<?php 

namespace Tests\Unit\Model;

use Exception;
use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Model\IoValue;

class IoValueTest extends TestCase
{
    /** @test */
    public function can_convert_to_hex()
    {
        $this->assertEquals('02', (new IoValue(hex2bin('02')))->toHex());
    }

    /** 
     * @test 
     * @dataProvider unsignedProvider
     */
    public function can_convert_to_unsigned($expected, $hex)
    {
        $this->assertEquals($expected, (new IoValue(hex2bin($hex)))->toUnsigned());
    }

    public function unsignedProvider()
    {
        return [
            [255, 'ff'],
            [65535, 'ffff'],
            [4294967295, 'ffffffff']
        ];
    }

    /** 
     * @test 
     * @dataProvider signedProvider
     */
    public function can_convert_to_signed($hex)
    {
        $this->assertEquals(-1, (new IoValue(hex2bin($hex)))->toSigned());
    }

    public function signedProvider()
    {
        return [
            ['ff'],
            ['ffff'],
            ['ffffffff']
        ];
    }

    /** 
     * @test 
     * @expectedException Uro\TeltonikaFmParser\Exception\IoValueLengthException
     */
    public function to_unsigned_invalid_length_throw_exception()
    {
        (new IoValue(hex2bin('000001')))->toUnsigned();
    }

    /** 
     * @test 
     * @expectedException Uro\TeltonikaFmParser\Exception\IoValueLengthException
     */
    public function to_signed_invalid_length_throw_exception()
    {
        (new IoValue(hex2bin('000001')))->toSigned();
    }

    /** @test */
    public function can_convert_to_string()
    {
        $this->assertEquals('0001', (string) new IoValue(hex2bin('0001')));
    }

    /** @test */
    public function can_serialize_json()
    {
        $this->assertJson('{"value":"0001"}', json_encode(new IoValue(hex2bin('0001'))));
    }

}