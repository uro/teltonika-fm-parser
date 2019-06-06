<?php

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Model\Imei;

interface Decoder
{
    public function decodeImei($payload): Imei;

    public function decodeData($payload);
}
