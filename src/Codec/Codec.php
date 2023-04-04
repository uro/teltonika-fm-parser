<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Codec;

use Uro\TeltonikaFmParser\Model\AvlDataCollection;
use Uro\TeltonikaFmParser\Model\IoElement;

interface Codec
{
    public function decodeAvlDataCollection(): AvlDataCollection;

    public function decodeIoElement(): IoElement;
}
