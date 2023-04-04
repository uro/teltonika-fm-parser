<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Model\IoProperty;
use Uro\TeltonikaFmParser\Model\IoValue;

class IoPropertyTest extends TestCase
{
    /**
     * @test
     */
    public function can_get_property_id(): void
    {
        $id = (new IoProperty(1, new IoValue('0')))->getId();

        $this->assertNotNull($id);
        $this->assertEquals(1, $id);
    }

    /**
     * @test
     */
    public function can_get_property_value(): void
    {
        $original = new IoValue('0');
        $value = (new IoProperty(1, $original))->getValue();

        $this->assertNotNull($value);
        $this->assertEquals($original, $value);
    }
}
