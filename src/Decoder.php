<?php

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Model\Imei;
use Uro\TeltonikaFmParser\Model\Model;

interface Decoder
{
    /**
     * Checks if it's payload with imei authentication
     *
     * @param string $payload
     *
     * @return bool
     */
    public function isAuthentication(string $payload): bool;

    /**
     * @param string $payload
     *
     * @return Model|Imei
     */
    public function decode(string $payload);
}
