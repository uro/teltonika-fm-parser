<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Model\Imei;

class ImeiTest extends TestCase
{
    private function validImei()
    {
        return new Imei('862259588834290');
    }

    /** @test */
    public function is_creating_imei_object_for_valid_imei()
    {
        $this->assertEquals('862259588834290', $this->validImei()->getImei());
    }

    /**
     * @test
     *
     * @expectedException \Uro\TeltonikaFmParser\Exception\InvalidArgumentException
     * @expectedExceptionMessage IMEI number is not valid.
     */
    public function is_validating_wrong_imei()
    {
        new Imei('123456789012345');
    }

    /** @test */
    public function is_json_serializable()
    {
        $imeiStr = "862259588834290";

        $imei = json_encode(new Imei($imeiStr));

        $this->assertJson('{"imei":"862259588834290"}', $imei);
    }

    /** @test */
    public function can_convert_to_string()
    {
        $this->assertEquals('862259588834290', (string) $this->validImei());
    }
}
