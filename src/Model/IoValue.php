<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

use Uro\TeltonikaFmParser\Exception\IoValueLengthException;

class IoValue extends Model
{
    public function __construct(private readonly string $binary)
    {
    }

    public function toHex(): string
    {
        return bin2hex($this->binary);
    }

    /**
     * @throws IoValueLengthException
     */
    public function toUnsigned(): int
    {
        $format = match (strlen($this->binary)) {
            1 => 'C',
            2 => 'S',
            4 => 'L',
            default => throw new IoValueLengthException(strlen($this->binary)),
        };

        return (int)$this->format($format);
    }

    /**
     * @throws IoValueLengthException
     */
    public function toSigned(): int
    {
        $format = match (strlen($this->binary)) {
            1 => 'c',
            2 => 's',
            4 => 'l',
            default => throw new IoValueLengthException(strlen($this->binary)),
        };

        return $this->format($format);
    }

    private function format(string $format): int
    {
        $raw = (array)unpack($format, pack($format, hexdec($this->toHex())));

        return $raw[1];
    }

    public function jsonSerialize(): array
    {
        return [
            'value' => $this->toHex(),
        ];
    }

    public function __toString(): string
    {
        return $this->toHex();
    }
}
