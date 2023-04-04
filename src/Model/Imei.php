<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

use Uro\TeltonikaFmParser\Exception\InvalidArgumentException;

class Imei extends Model
{
    private const IMEI_LENGTH = 15;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(private readonly string $imei)
    {
        if (!$this->isLuhn() || strlen($this->imei) !== self::IMEI_LENGTH) {
            throw new InvalidArgumentException("IMEI number is not valid.");
        }
    }

    public function getImei(): string
    {
        return $this->imei;
    }

    public function __toString(): string
    {
        return $this->getImei();
    }

    public function isLuhn(): bool
    {
        $str = '';
        foreach (str_split(strrev($this->imei)) as $i => $d) {
            $str .= $i % 2 !== 0 ? (int) $d * 2 : $d;
        }

        return array_sum(str_split($str)) % 10 === 0;
    }
}
