<?php declare(strict_types=1);

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SykesCottages\TestingWorkshop\Calculator;
use SykesCottages\TestingWorkshop\Till;

class TillTest extends TestCase
{
    private MockObject $calculator;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->calculator = $this->getMockBuilder(Calculator::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param int $valueOfTheItemToBeAdded
     * @return void
     * @dataProvider addingANumberToTheTillUpdatesTheRunningTotalCorrectlyDataProvider
     */
    public function testThatAddingANumberToTheTillUpdatesTheRunningTotalCorrectly(
        int $valueOfTheItemToBeAdded
    ): void {
        $till = new Till($this->calculator);

        $currentRunningTotal = $till->getRunningTotal();
        $expectedRunningTotal = $currentRunningTotal + $valueOfTheItemToBeAdded;

        $this->calculator->method('addTwoNumbersTogether')
            ->with($currentRunningTotal, $valueOfTheItemToBeAdded)
            ->willReturn($expectedRunningTotal);

        $till->addCostOfItemToRunningTotal($valueOfTheItemToBeAdded);

        $actualRunningTotal = $till->getRunningTotal();

        $this->assertEquals($actualRunningTotal, $expectedRunningTotal);
    }

    /**
     * @return int[][]
     */
    public function addingANumberToTheTillUpdatesTheRunningTotalCorrectlyDataProvider(): array
    {
        return [
            'Expects that adding 5 to the running total will increase the running total to 5' => [
                'valueOfTheItemToBeAdded' => 5
            ]
        ];
    }
}
