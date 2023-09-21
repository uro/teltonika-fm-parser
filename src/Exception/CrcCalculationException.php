<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Exception;

use Exception;

class CrcCalculationException extends Exception
{
    public function __construct()
    {
        parent::__construct('CRC calculation failed');
    }
}
