<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Exception\ParserException;
use Uro\TeltonikaFmParser\Model\Data;
use Uro\TeltonikaFmParser\Model\Imei;

class TcpDecoder implements Decoder
{
    public function isAuthentication(string $payload): bool
    {
        $firstByte = substr($payload, 0, 8);

        return hexdec($firstByte) !== 0;
    }

    public function isData(string $payload): bool
    {
        return !$this->isAuthentication($payload);
    }

    public function decodeAuthentication(string $payload): Imei
    {
        $hexImei = substr($payload, 4);

        return Imei::createFromHex($hexImei);
    }

    /**
     * @todo: Finish CRC, and Sensors
     *
     * @param string $payload
     *
     * @return array
     * @throws ParserException
     */
    public function decodeData(string $payload): array
    {
        $crc = substr($payload, strlen($payload) - 8, 8);

        $avlDataWithChecks = substr($payload, 16, -8);

        // Validating number of data;
        if (substr($avlDataWithChecks, 2, 2) !== substr($avlDataWithChecks, strlen($avlDataWithChecks) - 2, 2)) {
            throw new ParserException("First element count check is different than last element count check");
        }

        $numberOfElements = hexdec(substr($avlDataWithChecks, 2, 2));
        $avlData = substr($avlDataWithChecks, 4, -2);

        $position = 0;
        $resultData = [];

        for ($i = 0; $i < $numberOfElements; $i++) {
            $resultData[] = Data::createFromHex($avlData, $position);
        }

        return $resultData;
    }
}
