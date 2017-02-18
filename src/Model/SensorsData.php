<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

class SensorsData
{
    /**
     * @todo: Implement SensorsData
     *
     * @param string $payload
     *
     * @param int $position
     *
     * @return SensorsData
     */
    public static function createFromHex(string $payload, &$position): SensorsData
    {
        // IO element ID of Event generated -- skip
        $position += 2;

        $numberOfIoElements = substr($payload, $position, 2);
        $position += 2;

        $numberOfIo1BitElements = substr($payload, $position, 2);
        $position += 2;

        $position += 2 * hexdec($numberOfIo1BitElements) + 2 * hexdec($numberOfIo1BitElements);

        $numberOfIo2BitElements = substr($payload, $position, 2);
        $position += 2;

        $position += 2 * hexdec($numberOfIo2BitElements) + 4 * hexdec($numberOfIo2BitElements);

        $numberOfIo4BitElements = substr($payload, $position, 2);
        $position += 2;

        $position += 2 * hexdec($numberOfIo4BitElements) + 8 * hexdec($numberOfIo4BitElements);

        $numberOfIo8BitElements = substr($payload, $position, 2);
        $position += 2;
        $position += 2 * hexdec($numberOfIo8BitElements) + 16 * hexdec($numberOfIo8BitElements);

        return new SensorsData();
    }
}
