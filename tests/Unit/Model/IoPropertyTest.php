<?php 

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Model\IoProperty;
use Uro\TeltonikaFmParser\Model\IoValue;

class IoPropertyTest extends TestCase
{
    /** @test */
    public function can_get_property_id()
    {
        $id = (new IoProperty(1, new IoValue(0)))->getId();

        $this->assertNotNull($id);
        $this->assertEquals(1, $id);
    }

    /** @test */
    public function can_get_property_value()
    {
        $original = new IoValue(0);
        $value = (new IoProperty(1, $original))->getValue();

        $this->assertNotNull($value);
        $this->assertEquals($original, $value);
    }
}