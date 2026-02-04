<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Model\IoElement;
use Uro\TeltonikaFmParser\Model\IoProperty;
use Uro\TeltonikaFmParser\Model\IoValue;

class IoElementTest extends TestCase
{
    /**
     * @test
     */
    public function can_get_event_id(): void
    {
        $eventId = (new IoElement(0, 2))->getEventId();

        $this->assertEquals(0, $eventId);
    }

    /**
     * @test
     */
    public function can_get_number_of_elements(): void
    {
        $numberOfElements = (new IoElement(0, 2))->getNumberOfElements();

        $this->assertEquals(2, $numberOfElements);
    }

    /**
     * @test
     */
    public function can_get_properties(): void
    {
        $properties = [new IoProperty(1, new IoValue(''))];

        $ioElement = new IoElement(0, 2);
        $ioElement->addProperties($properties);

        $this->assertEqualsCanonicalizing($properties, $ioElement->getProperties());
    }
}
