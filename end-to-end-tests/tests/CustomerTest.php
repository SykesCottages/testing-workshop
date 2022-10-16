<?php declare(strict_types=1);

namespace SykesCottages\Tests;

use DI\DependencyException;
use DI\NotFoundException;
use SykesCottages\TestingWorkshop\CustomerDoesNotExistException;
use SykesCottages\TestingWorkshop\InvalidCustomerException;

class CustomerTest extends DatabaseTestCase
{
    /**
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->truncateTable('customers');
        $this->runSeedData();
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        $this->truncateTable('customers');
    }

    /**
     * @return \array[][]
     */
    public function seedData(): array
    {
        return [
            'customers' => [
                [
                    'customer_id' => '1',
                    'customer_forename' => 'test',
                    'customer_surname' => 'test',
                    'customer_email' => 'test1@example.com'
                ]
            ]
        ];
    }

    /**
     * @return void
     * @throws InvalidCustomerException
     * @throws DependencyException
     * @throws NotFoundException
     * @throws CustomerDoesNotExistException
     */
    public function testGetCustomerRecord(): void
    {
        $customerUseCase = $this->applicationContainer->get('SykesCottages\TestingWorkshop\CustomerUseCase');

        $customer = $customerUseCase->getCustomerById(1);

        $this->assertEquals('test1@example.com', $customer->getEmail());
    }

    /**
     * @return void
     * @throws DependencyException
     * @throws InvalidCustomerException
     * @throws NotFoundException
     */
    public function testCustomerCreationWithValidCredentials(): void
    {
        $customerUseCase = $this->applicationContainer->get('SykesCottages\TestingWorkshop\CustomerUseCase');

        $customer = $customerUseCase->createCustomerRecord(
            "Test",
            "Test",
            "test@example.org"
        );

        $this->assertEquals('2', $customer->getId());
    }

    /**
     * @return void
     * @throws DependencyException
     * @throws InvalidCustomerException
     * @throws NotFoundException
     */
    public function testThatAnExceptionIsThrownWithInvalidDetailsPassed(): void
    {
        $customerUseCase = $this->applicationContainer->get('SykesCottages\TestingWorkshop\CustomerUseCase');

        $this->expectException(InvalidCustomerException::class);
        $customer = $customerUseCase->createCustomerRecord(
            "Test",
            "Test",
            "invalid-email-address"
        );
    }
}
