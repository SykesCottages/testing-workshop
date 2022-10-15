<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

class CustomerUseCase
{
    private CustomerRepository $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param string $customerForename
     * @param string $customerSurname
     * @param string $customerEmail
     * @return Customer
     * @throws InvalidCustomerException
     */
    public function createCustomerRecord(
        string $customerForename,
        string $customerSurname,
        string $customerEmail
    ): Customer {

        if (empty($customerForename) && Customer::MAX_FORENAME_LENGTH > strlen($customerForename)) {
            throw new InvalidCustomerException("Forename");
        }

        if (empty($customerSurname) && Customer::MAX_SURNAME_LENGTH > strlen($customerSurname)) {
            throw new InvalidCustomerException("Surname");
        }

        if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL) && Customer::MAX_EMAIL_LENGTH > strlen($customerEmail)) {
            throw new InvalidCustomerException("Email");
        }

        $customer = new Customer($customerForename, $customerSurname, $customerEmail);
        return $this->customerRepository->createCustomerRecord($customer);
    }

    /**
     * @param int $id
     * @return Customer
     * @throws CustomerDoesNotExistException|InvalidCustomerException
     */
    public function getCustomerById(int $id): Customer
    {
        if (0 >= $id) {
            throw new InvalidCustomerException("Id");
        }

        return $this->customerRepository->getCustomerById($id);
    }
}
