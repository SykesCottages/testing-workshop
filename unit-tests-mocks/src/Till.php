<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

class Till
{
    private Calculator $calculator;
    private int $runningTotal = 0;

    /**
     * @param Calculator $calculator
     */
    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param int $costOfItem
     * @return void
     */
    public function addCostOfItemToRunningTotal(int $costOfItem): void
    {
        $this->runningTotal = $this->calculator->addTwoNumbersTogether(
            $this->runningTotal,
            $costOfItem
        );
    }

    /**
     * @return int
     */
    public function getRunningTotal(): int
    {
        return $this->runningTotal;
    }
}
