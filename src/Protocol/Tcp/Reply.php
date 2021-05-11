<?php 

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

class Reply 
{
    /**
     * Get accept module response
     *
     * @return string
     */
    public static function accept(): string
    {
        return pack('C', 1);
    }

    /**
     * Get reject module response
     *
     * @return string
     */
    public static function reject(): string
    {
        return pack('C', 0);
    }
}