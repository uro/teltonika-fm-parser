<?php 

namespace Uro\TeltonikaFmParser\Model;

class AvlDataCollection extends Model
{
    /**
     * Codec ID
     *
     * @var int
     */
    private $codecId;

    /**
     * Number of AVL data
     *
     * @var integer
     */
    private $numberOfData;

    /**
     * Array of AVL data
     *
     * @var array
     */
    private $avlData;

    public function __construct(int $codecId, int $numberOfData)
    {
        $this->codecId = $codecId;
        $this->numberOfData = $numberOfData;
    }

    /**
     * Get Codec ID
     *
     * @return int
     */
    public function getCodecId(): int
    {
        return $this->codecId;
    }

    /**
     * Get number of data
     *
     * @return int
     */
    public function getNumberOfData(): int
    {
        return $this->numberOfData;
    }

    /**
     * Get AVL data
     *
     * @return array
     */
    public function getAvlData(): array
    {
        return $this->avlData;
    }

    /**
     * Set AVL data
     *
     * @param array $avlData
     * @return AvlDataCollection
     */
    public function setAvlData(array $avlData): AvlDataCollection
    {
        $this->avlData = $avlData;

        return $this;
    }

}