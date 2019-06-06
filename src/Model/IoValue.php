<?php 

namespace Uro\TeltonikaFmParser\Model;

use Uro\TeltonikaFmParser\Exception\IoValueLengthException;

class IoValue extends Model
{
    private $binary;

    public function __construct($binary)
    {
        $this->binary = $binary;
    }

    public function toHex()
    {
        return bin2hex($this->binary);
    }

    public function toUnsigned()
    {
        switch(strlen($this->binary)) {
            case 1:
                $format = 'C';
                break;
            case 2:
                $format = 'S';
                break;
            case 4:
                $format = 'L';
                break;

            default:
                throw new IoValueLengthException(strlen($this->binary));
        }

        return $this->format($format);
    }

    public function toSigned()
    {
        switch(strlen($this->binary)) {
            case 1:
                $format = 'c';
                break;
            case 2:
                $format = 's';
                break;
            case 4:
                $format = 'l';
                break;

            default:
                throw new IoValueLengthException(strlen($this->binary));
        }

        return $this->format($format);
    }

    private function format(string $format)
    {
        return unpack($format, pack($format, hexdec($this->toHex())))[1];
    }

    public function jsonSerialize()
    {
        return [
            'value' => $this->toHex()
        ];
    }

    public function __toString()
    {
        return $this->toHex();
    }
}