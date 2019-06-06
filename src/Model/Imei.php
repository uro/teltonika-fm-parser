<?php

namespace Uro\TeltonikaFmParser\Model;

use Uro\TeltonikaFmParser\Exception\InvalidArgumentException;

class Imei extends Model
{
    const IMEI_LENGTH = 15;

    /**
     * @var string
     */
    private $imei;

    /**
     * @param mixed $imei
     *
     * @throws InvalidArgumentException
     */
    public function __construct($imei)
    {
        $this->imei = $imei;

        if (!$this->isLuhn($imei) || strlen($imei) !== self::IMEI_LENGTH) {
            throw new InvalidArgumentException("IMEI number is not valid.");
        }
    }

    /**
     * @return string
     */
    public function getImei(): string
    {
        return $this->imei;
    }

    public function __toString(): string
    {
        return $this->getImei();
    }

    /**
     * @param string $imei
     *
     * @return bool
     */
    public function isLuhn(): bool
    {
        $str = '';
        foreach (str_split(strrev($this->imei)) as $i => $d) {
            $str .= $i % 2 !== 0 ? $d * 2 : $d;
        }

        return array_sum(str_split($str)) % 10 === 0;
    }
}
