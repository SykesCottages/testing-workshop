<?php

use DI\ContainerBuilder;
use Dotenv\Dotenv;
use SykesCottages\TestingWorkshop\Customer;

require(__DIR__ . '/vendor/autoload.php');

try {
    $customerUseCase = (new ContainerBuilder())
        ->addDefinitions(__DIR__ . '/definitions.php')
        ->build()
        ->get('SykesCottages\TestingWorkshop\CustomerUseCase');

    $customer = $customerUseCase->createCustomerRecord(
        "Test",
        "Test",
        "test@example.org"
    );

    echo "Customer created with the ID ", $customer->getId(), PHP_EOL;

    $customer = $customerUseCase->getCustomerById($customer->getId());

    echo "Retrieved customer details for '", $customer->getForename(), " ", $customer->getSurname(),
        "' with the email address of ", $customer->getEmail(), PHP_EOL;

} catch (Exception $exception) {
    var_dump($exception);
}
