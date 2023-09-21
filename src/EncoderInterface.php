<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Support\Acknowledgeable;

interface EncoderInterface
{
    public function encodeAcknowledge(Acknowledgeable $acknowledgeable): string;
}
