<?php

namespace Uro\TeltonikaFmParser;

interface Encoder
{
    public function encode(string $payload): string;
}
