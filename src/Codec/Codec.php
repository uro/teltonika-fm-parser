<?php 

namespace Uro\TeltonikaFmParser\Codec;

use Uro\TeltonikaFmParser\Model\AvlDataCollection;

interface Codec 
{
    public function decodeAvlDataCollection(): AvlDataCollection;
}