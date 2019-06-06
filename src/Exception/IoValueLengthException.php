<?php 

namespace Uro\TeltonikaFmParser\Exception;

class IoValueLengthException extends \Exception
{
    public function __construct($length)
    {
        parent::__construct("Invalid IO property value length [$length]");
    }
}