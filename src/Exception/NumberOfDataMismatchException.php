<?php 

namespace Uro\TeltonikaFmParser\Exception;

class NumberOfDataMismatchException extends \Exception
{
    public function __construct($first, $last)
    {
        parent::__construct(
            "First number of data [$first] does not match last number of data [$last]"
        );
    }
}