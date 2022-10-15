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

        if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidCustomerException("Email address is invalid");
        }

        $customer = new Customer($customerForename, $customerSurname, $customerEmail);
        return $this->customerRepository->createCustomerRecord($customer);
    }

    /**
     * @param int $id
     * @return Customer
     * @throws CustomerDoesNotExistException
     */
    public function getCustomerById(int $id): Customer
    {
        return $this->customerRepository->getCustomerById($id);
    }
}
