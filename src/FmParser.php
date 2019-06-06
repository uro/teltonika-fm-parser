<?php 

namespace Uro\TeltonikaFmParser;

use Uro\TeltonikaFmParser\Support\Acknowledgeable;

class FmParser 
{
    private $decoder;

    public function __construct($protocol)
    {
        $namespace = 'Uro\\TeltonikaFmParser\\Protocol\\' . ucfirst($protocol) . '\\';

        $decoder = $namespace . 'Decoder';
        $this->decoder = new $decoder;
        
        $encoder = $namespace . 'Encoder';
        $this->encoder = new $encoder;
    }

    public function decodeImei($data)
    {
        return $this->decoder->decodeImei($data);
    }

    public function decodeData($data)
    {
        return $this->decoder->decodeData($data);
    }

    public function encodeAcknowledge(Acknowledgeable $acknowledgeable)
    {
        return $this->encoder->encodeAcknowledge($acknowledgeable);
    }
}