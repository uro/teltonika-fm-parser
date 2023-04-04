<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Model\Imei;
use Uro\TeltonikaFmParser\Protocol\Tcp\Packet;

interface DecoderInterface
{
    public function decodeImei(string $payload): Imei;

    public function decodeData(string $payload): Packet;
}
