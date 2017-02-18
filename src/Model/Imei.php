<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Model;

use JsonSerializable;
use Uro\TeltonikaFmParser\Model\Exception\InvalidArgumentException;

class Imei implements Model, JsonSerializable
{
    const IMEI_LENGTH = 15;

    /**
     * @var string
     */
    private $imei;

    /**
     * @param string $imei
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $imei)
    {
        if (!$this->isLuhn($imei) || strlen($imei) !== self::IMEI_LENGTH) {
            throw new InvalidArgumentException("IMEI number is not valid.");
        }

        $this->imei = $imei;
    }

    /**
     * @return string
     */
    public function getImei(): string
    {
        return $this->imei;
    }

    public function jsonSerialize(): array
    {
        return [
            'imei' => $this->getImei()
        ];
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
    private function isLuhn(string $imei): bool
    {
        $str = '';
        foreach (str_split(strrev((string)$imei)) as $i => $d) {
            $str .= $i % 2 !== 0 ? $d * 2 : $d;
        }

        return array_sum(str_split($str)) % 10 === 0;
    }

    public static function createFromHex(string $hexData): Imei
    {
        $imei = hex2bin($hexData);

        return new Imei($imei);
    }
}
