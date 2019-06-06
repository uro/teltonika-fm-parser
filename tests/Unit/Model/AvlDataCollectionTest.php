<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Uro\TeltonikaFmParser\Model\AvlDataCollection;

class AvlDataCollectionTest extends TestCase
{
    /** @test */
    public function can_get_codec_id()
    {
        $this->assertEquals(8, (new AvlDataCollection(8, 1))->getCodecId());
    }

    /** @test */
    public function can_get_number_of_data()
    {
        $this->assertEquals(1, (new AvlDataCollection(8, 1))->getNumberOfData());
    }

    /** @test */
    public function can_get_avl_data()
    {
        $avlDataCollection = (new AvlDataCollection(8, 1))->setAvlData(['fake-avldata']);

        $this->assertEquals(['fake-avldata'], $avlDataCollection->getAvlData());
    }
}