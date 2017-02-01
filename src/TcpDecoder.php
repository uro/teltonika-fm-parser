<?php

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Exception\ParserException;
use Uro\TeltonikaFmParser\Model\Imei;
use Uro\TeltonikaFmParser\Model\Model;

class TcpDecoder implements Decoder
{
    /**
     * @param string $payload
     *
     * @return bool
     */
    public function isAuthentication(string $payload): bool
    {
        $firstByte = substr($payload, 0, 8);

        return hexdec($firstByte) !== 0;
    }

    /**
     * @todo: Implement data validation
     *
     * @param string $payload
     *
     * @return bool
     */
    public function isData(string $payload): bool
    {
        return !$this->isAuthentication($payload);
    }

    /**
     * @param string $payload
     *
     * @return Model
     */
    public function decode(string $payload)
    {
        /** If it's imei authentication */
        if ($this->isAuthentication($payload)) {

            return $this->decodeImei($payload);
        }

        return $this->decodeData($payload);
    }

    /**
     * @param string $payload
     *
     * @return Imei
     */
    private function decodeImei(string $payload): Imei
    {
        $hexImei = substr($payload, 4);

        return new Imei(hex2bin($hexImei));
    }

    /**
     * @param string $payload
     */
    private function decodeData(string $payload)
    {
        $crc = substr($payload, strlen($payload) - 8, 8);

        $avlData = substr($payload, 16, -8);

        // Validating number of data;
        if (substr($avlData, 2, 2) !== substr($avlData, strlen($avlData) -2, 2)) {
            throw new ParserException("Parsing error");
        }

        // parse avl array
        // parse in loop data elements
        // return object of data, or something., object should contains number of elements, elements and ioelement object


        $dataNumber = substr($avlData, 2, 2);

    }
}
