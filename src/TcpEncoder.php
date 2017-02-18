<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Exception\InvalidArgumentException;

class TcpEncoder implements Encoder
{
    public function encodeAuthentication(bool $isAuthenticated): string
    {
        if ($isAuthenticated) {
            return '01';
        }

        return '00';
    }

    public function encodeData(int $numberOfRecords): string
    {
        if ($numberOfRecords < 0) {
            throw new InvalidArgumentException("Value must be 0 or more");
        }

        return dechex($numberOfRecords);
    }
}
