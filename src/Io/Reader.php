<?php 

namespace Uro\TeltonikaFmParser\Io;

use PhpBinaryReader\BinaryReader;
use PhpBinaryReader\Endian;

class Reader extends BinaryReader
{
    public function __construct($input)
    {
        parent::__construct(
            ctype_xdigit($input) ? hex2bin($input) : $input,
            Endian::BIG
        );
    }
}