<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Io;

use PhpBinaryReader\BinaryReader;
use PhpBinaryReader\Endian;

class Reader extends BinaryReader
{
    public function __construct(string $input)
    {
        parent::__construct(
            ctype_xdigit($input) ? (string) hex2bin($input) : $input,
            Endian::BIG
        );
    }
}
