<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Exception;

use Exception;

class IoValueLengthException extends Exception
{
    public function __construct(int $length)
    {
        parent::__construct("Invalid IO property value length [$length]");
    }
}
