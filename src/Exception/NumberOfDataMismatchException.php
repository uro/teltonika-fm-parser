<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Exception;

use Exception;

class NumberOfDataMismatchException extends Exception
{
    public function __construct(int $first, int $last)
    {
        parent::__construct(
            "First number of data [$first] does not match last number of data [$last]"
        );
    }
}
