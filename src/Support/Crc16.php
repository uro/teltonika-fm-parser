<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Support;

use Uro\TeltonikaFmParser\Io\Reader;

class Crc16
{
    public function calculate(string $input): int
    {
        $reader = new Reader($input);
        $length = $reader->getEofPosition();

        $polynom = 0xA001;
        $crc = 0;
        for ($i = 0; $i < $length; $i++) {
            $crc ^= $reader->readUInt8();
            for ($j = 0; $j < 8; $j++) {
                $crc = ($crc & 0x0001) != 0 ? ($crc >> 1) ^ $polynom : $crc >> 1;
            }
        }

        return $crc;
    }
}
