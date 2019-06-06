<?php

namespace Uro\TeltonikaFmParser\Model;

abstract class Model implements \JsonSerializable
{
    public function jsonSerialize()
    {
       return  get_object_vars($this);
    }
}
