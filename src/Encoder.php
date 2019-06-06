<?php

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Support\Acknowledgeable;

interface Encoder
{
    public function encodeAcknowledge(Acknowledgeable $acknoledgeable);
}
