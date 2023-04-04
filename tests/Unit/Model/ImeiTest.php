<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Exception\InvalidArgumentException;
use Uro\TeltonikaFmParser\Model\Imei;

class ImeiTest extends TestCase
{
    private function validImei(): Imei
    {
        return new Imei('862259588834290');
    }

    /**
     * @test
     */
    public function is_creating_imei_object_for_valid_imei(): void
    {
        $this->assertEquals('862259588834290', $this->validImei()->getImei());
    }

    /**
     * @test
     */
    public function is_validating_wrong_imei(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('IMEI number is not valid.');
        new Imei('123456789012345');
    }

    /**
     * @test
     * @throws InvalidArgumentException
     */
    public function is_json_serializable(): void
    {
        $imeiStr = "862259588834290";

        $imei = json_encode(new Imei($imeiStr));

        $this->assertJson('{"imei":"862259588834290"}', $imei);
    }

    /**
     * @test
     */
    public function can_convert_to_string(): void
    {
        $this->assertEquals('862259588834290', (string)$this->validImei());
    }
}
