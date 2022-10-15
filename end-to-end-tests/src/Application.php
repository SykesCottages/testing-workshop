<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

class Application
{
    private CustomerUseCase $customerUseCase;

    /**
     * @param CustomerUseCase $customerUseCase
     */
    public function __construct(CustomerUseCase $customerUseCase)
    {
        $this->customerUseCase = $customerUseCase;
    }

    /**
     * @param string $controller
     * @param string $method
     * @return void
     * @throws InvalidRequestException
     */
    public function route(string $controller, string $method): void
    {
        switch($controller) {
            case 'customer':
                $this->customer($method);
                break;
            default:
                throw new InvalidRequestException('Invalid controller specified');
        }
    }

    /**
     * @param string $method
     * @return void
     * @throws CustomerDoesNotExistException
     * @throws InvalidCustomerException
     * @throws InvalidRequestException
     */
    public function customer(string $method): void
    {
        switch($method) {
            case 'GET':
                echo json_encode($this->customerUseCase->getCustomerById((int) $_GET['id']));
                break;
            case 'POST':
                echo json_encode($this->customerUseCase->createCustomerRecord(
                    $_POST['forename'],
                    $_POST['surname'],
                    $_POST['email'],
                ));
                break;
            default:
            throw new InvalidRequestException('Invalid method for controller');
        }
    }
}
