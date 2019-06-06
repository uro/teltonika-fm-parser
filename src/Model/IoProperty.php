<?php 

namespace Uro\TeltonikaFmParser\Model;

use Uro\TeltonikaFmParser\Model\IoValue;

class IoProperty extends Model
{
    /**
     * Property ID in AVL Packet
     *
     * @var int
     */
    private $id;

    /**
     * Property value
     *
     * @var IoValue
     */
    private $value;

    /**
     * IO property
     *
     * @param integer $id
     * @param IoValue $value
     */
    public function __construct($id, IoValue $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * Get property ID
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get property value
     *
     * @return IoValue
     */
    public function getValue()
    {
        return $this->value;
    }
}