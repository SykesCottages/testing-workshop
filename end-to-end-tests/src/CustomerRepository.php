<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

use mysqli;

class CustomerRepository
{
    private mysqli $database;

    public function __construct(mysqli $database)
    {
        $this->database = $database;
    }

    public function createCustomerRecord(Customer $customer): Customer
    {
        $query = "INSERT INTO `customers` (customer_forename, customer_surname, customer_email) VALUES (?, ?, ?);";

        $preparedStatement = $this->database->prepare($query);

        $forename = $customer->getForename();
        $surname = $customer->getSurname();
        $email = $customer->getEmail();

        $preparedStatement->bind_param(
            'sss',
            $forename,
            $surname,
            $email
        );

        $preparedStatement->execute();

        $customer->setId($this->database->insert_id);

        return $customer;
    }

    public function getCustomerById(int $customerId): Customer
    {
        $query = "SELECT customer_forename, customer_surname, customer_email FROM `customers` WHERE customer_id = ?;";

        $preparedStatement = $this->database->prepare($query);

        $preparedStatement->bind_param(
            'i',
            $customerId
        );

        $preparedStatement->execute();

        $preparedStatement->bind_result(
            $customerForename,
            $customerSurname,
            $customerEmail
        );

        if (!$preparedStatement->fetch()) {
            throw new CustomerDoesNotExistException("Customer does not exist");
        }

        $customer = new Customer($customerForename, $customerSurname, $customerEmail);
        $customer->setId($customerId);

        return $customer;
    }
}
