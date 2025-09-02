<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

require_once 'cartridges/cartridges.php';

class CartridgesTest extends TestCase
{
    /**
     * Positive testing
     */

    #[DataProvider('provideCartridgesPasses')]
    public function testCartridgesPasses(int $cartridges, float $discount): void
    {
        $this->assertEquals(calculateDiscount($cartridges), $discount);
    }
    public static function provideCartridgesPasses(): array
    {
        // Valid equivalence partitions: 5-99 and 100-MAX INTEGER
        return [
            [5, 0.0],       // Partition 5-99: lower valid boundary
            [6, 0.0],
            [47, 0.0],
            [98, 0.0],
            [99, 0.0],      // Partition 5-99: upper valid boundary
            [100, 0.2],     // Partition 100-MAX INTEGER: lower valid boundary
            [101, 0.2],
            [167, 0.2]
            
            // Because of using strongly typed PHP, the edge cases implying data type conversion cannot be tested
        ];
    }
    
    /**
     * Negative testing
     */

     #[DataProvider('provideCartridgesFails')]
     public function testCartridgesFails(int $cartridges): void
     {
        $this->expectException(UnexpectedValueException::class);
        calculateDiscount($cartridges);
     }
     public static function provideCartridgesFails(): array
     {
        return [
            [-15], [-2], [-1],      // Invalid equivalence partition: -MIN INTEGER - -1
            [0],                    // Invalid equivalence partition: 0
            [1], [2], [3], [4],     // Invalid equivalence partition: 1-4
            [-10], [-167]           // Edge cases
        ];
     }
}