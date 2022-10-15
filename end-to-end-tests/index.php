<?php

use DI\ContainerBuilder;
use Dotenv\Dotenv;
use SykesCottages\TestingWorkshop\Customer;
use SykesCottages\TestingWorkshop\CustomerDoesNotExistException;
use SykesCottages\TestingWorkshop\InvalidCustomerException;

require(__DIR__ . '/vendor/autoload.php');

try {
    $application = (new ContainerBuilder())
        ->addDefinitions(__DIR__ . '/definitions.php')
        ->build()
        ->get('SykesCottages\TestingWorkshop\Application');

    $application->route(
        $_GET['controller'] ?: '',
        $_SERVER['REQUEST_METHOD'] ?: ''
    );
} catch (InvalidCustomerException $exception) {
    echo json_encode($exception->getMessage());
    http_response_code(400);
} catch (CustomerDoesNotExistException $exception) {
    echo json_encode($exception->getMessage());
    http_response_code(404);
} catch (Exception $exception) {
    echo json_encode($exception->getMessage());
    http_response_code(500);
}
