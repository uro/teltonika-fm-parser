<?php

namespace Tests\Unit\Model;

use Uro\TeltonikaFmParser\Model\Imei;


class ImeiTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function is_creating_imei_object_for_valid_imei()
    {
        $imeiStr = "862259588834290";

        $imei = new Imei($imeiStr);

        $this->assertEquals(Imei::class, get_class($imei));
        $this->assertEquals('862259588834290', $imei->getImei());
    }

    /**
     * @test
     *
     * @expectedException \Uro\TeltonikaFmParser\Model\Exception\InvalidArgumentException
     * @expectedExceptionMessage IMEI number is not valid.
     */
    public function is_validating_wrong_imei()
    {
        $payload = "123456789012345";

        new Imei($payload);
    }

    /** @test */
    public function is_json_serializable()
    {
        $imeiStr = "862259588834290";

        $imei = json_encode(new Imei($imeiStr));

        $this->assertJson('{"imei":"862259588834290"}', $imei);
    }

    /** @test */
    public function is_creating_imei_from_hex()
    {
        $payload = "383632323539353838383334323930";

        $imei = Imei::createFromHex($payload);

        $this->assertEquals(Imei::class, get_class($imei));
        $this->assertEquals('862259588834290', $imei->getImei());
    }
}
