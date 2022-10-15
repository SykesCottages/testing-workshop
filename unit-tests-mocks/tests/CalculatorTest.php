<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SykesCottages\TestingWorkshop\Calculator;

class CalculatorTest extends TestCase
{
    /**
     * @param int $firstValue
     * @param int $secondValue
     * @return void
     * @dataProvider addTwoNumbersTogetherPositiveDataProvider
     */
    public function testThatTwoNumbersAreAddedTogetherAndTheResultingSumIsReturned(
        int $firstValue,
        int $secondValue
    ): void {
        $calculator = new Calculator();
        $expectedReturnValue = $firstValue + $secondValue;
        $actualReturnedValue = $calculator->addTwoNumbersTogether($firstValue, $secondValue);
        $this->assertEquals($expectedReturnValue, $actualReturnedValue);
    }

    /**
     * @return int[][]
     */
    public function addTwoNumbersTogetherPositiveDataProvider(): array
    {
        return [
            'Adding the values 2 and 3 should return with the correct value' => [
                'firstValue' => 2,
                'secondValue' => 3
            ]
        ];
    }
}
