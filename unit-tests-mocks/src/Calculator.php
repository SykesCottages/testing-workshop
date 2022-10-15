<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

class Calculator
{
    /**
     * @param int $firstNumber
     * @param int $secondNumber
     * @return int
     */
    public function addTwoNumbersTogether(int $firstNumber, int $secondNumber): int
    {
        return $firstNumber + $secondNumber;
    }
}
