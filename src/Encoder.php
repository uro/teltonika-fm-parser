<?php

namespace Uro\TeltonikaFmParser;

interface Encoder
{
    public function encodeAuth(bool $isAuthenticated): string;

    public function encodeData(int $numberOfRecords): string;
}
