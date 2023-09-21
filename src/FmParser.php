<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Model\Imei;
use Uro\TeltonikaFmParser\Protocol\Tcp\Packet;
use Uro\TeltonikaFmParser\Support\Acknowledgeable;

class FmParser
{
    private DecoderInterface $decoder;

    private EncoderInterface $encoder;

    public function __construct(string $protocol)
    {
        $namespace = 'Uro\\TeltonikaFmParser\\Protocol\\' . ucfirst($protocol) . '\\';

        /** @var DecoderInterface $decoder */
        $decoder = new ($namespace . 'Decoder');
        $this->decoder = $decoder;

        /** @var EncoderInterface $encoder */
        $encoder = new ($namespace . 'Encoder');
        $this->encoder = new $encoder();
    }

    public function decodeImei(string $data): Imei
    {
        return $this->decoder->decodeImei($data);
    }

    public function decodeData(string $data): Packet
    {
        return $this->decoder->decodeData($data);
    }

    public function encodeAcknowledge(Acknowledgeable $acknowledgeable): string
    {
        return $this->encoder->encodeAcknowledge($acknowledgeable);
    }
}
