<?php declare(strict_types=1);

namespace SykesCottages\Tests;

use GuzzleHttp\Exception\GuzzleException;

class ApplicationTest extends RequestTestCase
{
    /**
     * @return void
     * @throws GuzzleException
     */
    public function testGetCustomerByIdShouldFailWhenNoCustomerRecordExists(): void
    {
        $response = $this->request('GET', 'customer', ['id' => 44]);
        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals($response->getStatusCode(), '404');
        $this->assertEquals("Customer does not exist", $responseData);
    }

    /**
     * @return void
     * @throws GuzzleException
     */
    public function testGetCustomerByIdShouldFailWhenInvalidCustomerIdIsPassed(): void
    {
        $response = $this->request('GET', 'customer', ['id' => 0]);
        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals($response->getStatusCode(), '400');
        $this->assertEquals("Customer Id is invalid", $responseData);
    }

    /**
     * @param array $invalidCustomerData
     * @param string $failedField
     * @return void
     * @throws GuzzleException
     * @dataProvider dataForInvalidCustomers
     */
    public function testCreateACustomerWithInvalidCredentialsAndItShouldFail(
        array $invalidCustomerData,
        string $failedField
    ): void {
        $response = $this->request('POST', 'customer', [], $invalidCustomerData);
        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals($response->getStatusCode(), '400');
        $this->assertEquals("Customer $failedField is invalid", $responseData);
    }


    /**
     * @return void
     * @throws GuzzleException
     * @dataProvider dataForValidCustomers
     */
    public function testCreateACustomerWithValidCredentialsAndRetrieveThatCustomer(array $validAndExpectedCustomerData)
    {
        $response = $this->request('POST', 'customer', [], $validAndExpectedCustomerData);
        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals($response->getStatusCode(), '200');
        $this->assertIsArray($responseData);
        $this->assertEquals($validAndExpectedCustomerData, $responseData);

        $response = $this->request('GET', 'customer', ['id' => $validAndExpectedCustomerData['id']]);
        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals($response->getStatusCode(), '200');
        $this->assertIsArray($responseData);
        $this->assertEquals($validAndExpectedCustomerData, $responseData);
    }

    /**
     * @return array[]
     */
    public function dataForInvalidCustomers(): array
    {
        return [
            'it should fail to create a customer with an invalid email' => [
                'invalidCustomerData' => [
                    'forename' => 'test',
                    'surname' => 'test',
                    'email' => 'invalid-email-address'
                ],
                'failedField' => 'Email'
            ],
            'it should fail to create a customer with a blank forename' => [
                'invalidCustomerData' => [
                    'forename' => '',
                    'surname' => 'test',
                    'email' => 'test@example.com'
                ],
                'failedField' => 'Forename'
            ],
            'it should fail to create a customer with a blank surname' => [
                'invalidCustomerData' => [
                    'forename' => 'test',
                    'surname' => '',
                    'email' => 'test@example.com'
                ],
                'failedField' => 'Surname'
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function dataForValidCustomers(): array
    {
        return [
            'it should create a customer with generic credentials' => [
                'validAndExpectedCustomerData' => [
                    'id' => 1,
                    'forename' => 'test',
                    'surname' => 'test',
                    'email' => 'test@example.com'
                ]
            ],
            'it should create a customer with an hyphen in the forename' => [
                'validAndExpectedCustomerData' => [
                    'id' => 2,
                    'forename' => 'test-test',
                    'surname' => 'test',
                    'email' => 'test@example.com'
                ]
            ],
            'it should create a customer with an apostrophe in the surname' => [
                'validAndExpectedCustomerData' => [
                    'id' => 3,
                    'forename' => 'test',
                    'surname' => "o'testy",
                    'email' => 'test@example.com'
                ]
            ]
        ];
    }
}
