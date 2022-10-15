<?php declare(strict_types=1);

namespace SykesCottages\Tests;

use DI\Container;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use SykesCottages\TestingWorkshop\InvalidCustomerException;

class CustomerTest extends DatabaseTestCase
{
    /**
     * @return void
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
     * @return array[][]
     */
    public function seedData(): array
    {
        return [
            'customers' => [
                [
                    'customer_id' => 1,
                    'customer_forename' => 'test',
                    'customer_surname' => 'test',
                    'customer_email' => 'test1@example.com'
                ]
            ]
        ];
    }

    /**
     * @return void
     */
    public function testGetCustomerRecord(): void
    {
        $customerUseCase = $this->applicationContainer->get('SykesCottages\TestingWorkshop\CustomerUseCase');

        $customer = $customerUseCase->getCustomerById(1);

        $this->assertEquals('test1@example.com', $customer->getEmail());
    }

    /**
     * @return void
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
