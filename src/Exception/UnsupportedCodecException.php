<?php 

namespace Uro\TeltonikaFmParser\Exception;

class UnsupportedCodecException extends \Exception
{
    public function __construct($codecId)
    {
        parent::__construct("Unsupported codec [$codecId]");
    }
}