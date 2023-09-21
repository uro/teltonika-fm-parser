<?php

declare(strict_types=1);

namespace Uro\TeltonikaFmParser\Support\Testing;

use Uro\TeltonikaFmParser\Exception\NumberOfDataMismatchException;
use Uro\TeltonikaFmParser\Io\Reader;

trait TestAvlData
{
    abstract protected function codecClass(): string;

    abstract protected function assertGpsElement($gpsElement): void;

    abstract protected function assertIoElement($ioElement): void;

    /**
     * @test
     */
    public function number_of_data_mismatch_throw_exception(): void
    {
        $this->expectException(NumberOfDataMismatchException::class);
        $reader = new Reader(
            '08'.                           // Codec ID
            '00'.                           // Number of data
            '01'                            // Different number of data
        );
        $codec = $this->codecClass();

        (new $codec($reader))->decodeAvlDataCollection();
    }

    /**
     * @test
     */
    public function can_decode_avl_data_collection(): void
    {
        $reader = new Reader($this->validAvlCollectionData());
        $codec = $this->codecClass();

        $avlDataCollection = (new $codec($reader))->decodeAvlDataCollection();

        $this->assertNotNull($avlDataCollection);
        $this->assertEquals(8, $avlDataCollection->getCodecId());
        $this->assertEquals(1, $avlDataCollection->getNumberOfData());
        $this->assertCount(1, $avlDataCollection->getAvlData());
        $this->assertAvlData($avlDataCollection->getAvlData()[0]);
        $this->assertTrue($reader->isEof(), 'The codec did not read all avl collection bytes');
    }

    /**
     * @test
     */
    public function can_decode_avl_data(): void
    {
        $reader = new Reader($this->validAvlData());
        $codec = $this->codecClass();

        $avlData = (new $codec($reader))->decodeAvlData();

        $this->assertAvlData($avlData);
    }

    private function assertAvlData($avlData): void
    {
        $this->assertNotNull($avlData);
        $this->assertEquals(1185345998335, $avlData->getTimestamp());
        $this->assertEquals(0, $avlData->getPriority());
        $this->assertGpsElement($avlData->getGpsElement());
        $this->assertIoElement($avlData->getIoElement());
    }

    private function validAvlCollectionData(): string
    {
        return
            '08'.                           // Codec ID
            '01'.                           // Number of data
            $this->validAvlData().          // AVL Data
            '01';                           // Number of data
    }

    private function validAvlData(): string
    {
        return
            '00000113fc208dff'.             // Timestamp in milliseconds 1185345998335 (25 Jul 2007 06:46:38 UTC)
            '00'.                           // Priority
            $this->validGpsElement().       // Gps Element
            $this->validIoElement();        // IO Element
    }
}
