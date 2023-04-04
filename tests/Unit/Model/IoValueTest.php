<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Exception\IoValueLengthException;
use Uro\TeltonikaFmParser\Model\IoValue;

class IoValueTest extends TestCase
{
    /**
     * @test
     */
    public function can_convert_to_hex(): void
    {
        $this->assertEquals('02', (new IoValue(hex2bin('02')))->toHex());
    }

    /**
     * @test
     * @dataProvider unsignedProvider
     * @throws IoValueLengthException
     */
    public function can_convert_to_unsigned($expected, $hex): void
    {
        $this->assertEquals($expected, (new IoValue(hex2bin($hex)))->toUnsigned());
    }

    public static function unsignedProvider(): array
    {
        return [
            [255, 'ff'],
            [65535, 'ffff'],
            [4294967295, 'ffffffff'],
        ];
    }

    /**
     * @test
     * @dataProvider signedProvider
     * @throws IoValueLengthException
     */
    public function can_convert_to_signed(string $hex): void
    {
        $this->assertEquals(-1, (new IoValue(hex2bin($hex)))->toSigned());
    }

    public static function signedProvider(): array
    {
        return [
            ['ff'],
            ['ffff'],
            ['ffffffff'],
        ];
    }

    /**
     * @test
     */
    public function to_unsigned_invalid_length_throw_exception(): void
    {
        $this->expectException(IoValueLengthException::class);
        (new IoValue(hex2bin('000001')))->toUnsigned();
    }

    /**
     * @test
     */
    public function to_signed_invalid_length_throw_exception(): void
    {
        $this->expectException(IoValueLengthException::class);
        (new IoValue(hex2bin('000001')))->toSigned();
    }

    /**
     * @test
     */
    public function can_convert_to_string(): void
    {
        $this->assertEquals('0001', (string)new IoValue(hex2bin('0001')));
    }

    /**
     * @test
     */
    public function can_serialize_json(): void
    {
        $this->assertJson('{"value":"0001"}', json_encode(new IoValue(hex2bin('0001'))));
    }

}
