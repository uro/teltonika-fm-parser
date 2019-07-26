<?php 

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

use Uro\TeltonikaFmParser\Encoder as IEncoder;
use Uro\TeltonikaFmParser\Support\Acknowledgeable;

class Encoder implements IEncoder
{
    public function encodeAcknowledge(Acknowledgeable $ack)
    {
        return pack('N', $ack->getNumberOfAcceptedData());
    }
}