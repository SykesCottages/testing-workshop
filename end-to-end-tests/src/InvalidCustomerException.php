<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

use Exception;

class InvalidCustomerException extends Exception
{
    public function __construct(string $field)
    {
        parent::__construct("Customer ${field} is invalid");
    }
}
