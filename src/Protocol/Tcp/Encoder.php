<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

use Uro\TeltonikaFmParser\EncoderInterface;
use Uro\TeltonikaFmParser\Support\Acknowledgeable;

class Encoder implements EncoderInterface
{
    public function encodeAcknowledge(Acknowledgeable $acknowledgeable): string
    {
        return pack('N', $acknowledgeable->getNumberOfAcceptedData());
    }
}
