<?php 

namespace Uro\TeltonikaFmParser\Protocol\Tcp;

use Uro\TeltonikaFmParser\Support\Crc16;
use Uro\TeltonikaFmParser\Model\AvlDataCollection;
use Uro\TeltonikaFmParser\Support\Acknowledgeable;

class Packet implements Acknowledgeable
{
    private $preamble;

    private $avlDataArrayLength;
    
    /**
     * Undocumented variable
     *
     * @var Uro\TeltonikaFmParser\Model\AvlDataCollection
     */
    private $avlDataCollection;

    private $crc;

    public function __construct($preamble, $avlDataArrayLength, AvlDataCollection $avlDataCollection, $crc)
    {
        $this->preamble = $preamble;
        $this->avlDataArrayLength = $avlDataArrayLength;
        $this->avlDataCollection = $avlDataCollection;
        $this->crc = $crc;
    }

    /**
     * Get preamble
     *
     * @return int
     */
    public function getPreamble(): int
    {
        return $this->preamble;
    }

    /**
     * Get AVL data array length
     *
     * @return int
     */
    public function getAvlDataArrayLength(): int 
    {
        return $this->avlDataArrayLength;
    }

    /**
     * Get AVL data collection
     *
     * @return AvlDataCollection
     */
    public function getAvlDataCollection(): AvlDataCollection 
    {
        return $this->avlDataCollection;
    }

    /**
     * Get number of accepted data
     *
     * @return int
     */
    public function getNumberOfAcceptedData(): int
    {
        return $this->avlDataCollection->getNumberOfData();
    }

    /**
     * Get CRC
     *
     * @return int
     */
    public function getCrc(): int
    {
        return $this->crc;
    }

    /**
     * Check if packet CRC equals calculated CRC
     *
     * @return boolean
     */
    public function checkCrc(string $input): bool
    {
        return $this->crc == (new Crc16)->calc($input);
    }
}