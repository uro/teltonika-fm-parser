<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Exception;

use Exception;

class UnsupportedCodecException extends Exception
{
    public function __construct(int $codecId)
    {
        parent::__construct("Unsupported codec [$codecId]");
    }
}
