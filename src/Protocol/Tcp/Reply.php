<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

class Reply
{
    public static function accept(): string
    {
        return pack('C', 1);
    }

    public static function reject(): string
    {
        return pack('C', 0);
    }
}
