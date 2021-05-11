<?php 

namespace Uro\TeltonikaFmParser\Support\Testing;

use Uro\TeltonikaFmParser\Io\Reader;

trait Test15BytesGpsElement 
{
    protected abstract function codecClass();

    /** @test */
    public function can_decode_gps_element()
    {
        $reader = new Reader($this->validGpsElement());
        $codec = $this->codecClass();

        $gpsElement = (new $codec($reader))->decodeGpsElement();

        $this->assertGpsElement($gpsElement);
    }

    protected function assertGpsElement($gpsElement)
    {
        $this->assertNotNull($gpsElement);
        $this->assertEquals(25.3032016, $gpsElement->getLongitude());
        $this->assertEquals(54.7146368, $gpsElement->getLatitude());
        $this->assertEquals(111, $gpsElement->getAltitude());
        $this->assertEquals(214, $gpsElement->getAngle());
        $this->assertEquals(4, $gpsElement->getSatellites());
        $this->assertEquals(6, $gpsElement->getSpeed());
    }

    protected function validGpsElement()
    {
        return 
            '0f14f650'.                     // Longitude 253032016 = 25,3032016o N
            '209cca80'.                     // Latitude 547146368 = 54,7146368 o E
            '006f'.                         // Altitude 111 meters
            '00d6'.                         // Angle 214o
            '04'.                           // 4 Visible sattelites
            '0006';                         // 6 km/h speed
    }
}