<?php 

namespace Uro\TeltonikaFmParser\Exception;

use Mockery\Exception;

class CrcMismatchException extends Exception
{
    public function __construct()
    {
        parent::__construct('Provided CRC is different than calculated CRC');
    }
}