# Sykes Cottages Testing Workshop Exercises

This repository contains the source code used for an internal training sessions at Sykes Cottages.
Its purpose is to demonstrate different testing techniques.

The solutions are provided with each exercise and if you want to challenge yourself delete the test code.

## Requirements

- Docker
- Docker-compose
- Python >= 3.9

## Instructions

Each exercise contains boilerplate code to run the tests without additional setup and can be run with a single shell script.

You can run each exercise with:
```shell
./run-tests.sh
```

# Exercises

## 1. Unit Tests

### Story
As a member of the finance team, I need a calculator system that can add two whole numbers together and provide me with the sum of those numbers.

### Objective
Write some the code and tests to satisfy the story.

### Notes
We just need some basic code and a simple unit test.

##  2. Unit Tests with Mocks

### Story 

As a member of the finance team, I need a till system that can store a whole number running total, allow me to add a whole number to the running total using the previous calculator system and get the running total.

### Objective
Write some the code and tests to satisfy the story.

### Notes
Expand off the previous exercise and build the till on top of the calculator.

## 3. Integration Tests

### Story

As a member of the customer service team, I need to be able to store a customer's forename, surname and a valid email address. I also want the ability to retrieve a customer by a unique identifier.

### Objective
The code already exists, so write some code to prove that the code does what it's supposed to.

### Notes
Code integrates with MySQL and we have provided a `DatabaseTestCase` class to truncate and seed data for testing.
There are two functions available; 
- the first is `truncateTable` to help clear a database table 
- the other is `runSeedData` which runs requires you to overload the `seedData` function and return the following structure:
```php
[
    'TABLE_NAME' => [
        [
            'COLUMN_1' => 'VALUE_1',
            'COLUMN_2' => 'VALUE_2'
        ]
    ]
]
```

#### Example Setup
```php
    public function setUp(): void
    {
        parent::setUp();
        $this->truncateTable('customers');
        $this->runSeedData();
    }

    public function tearDown(): void
    {
        $this->truncateTable('customers');
    }

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
```

## 4. End-to-End Tests

### Story

As a member of the customer service team, I need to be able to store a customer's forename, surname and a valid email address. I also want the ability to retrieve a customer by a unique identifier.

### Objective
The application already exists, so write some code to prove that the code does what it's supposed to.

### Notes
Application already exists and running within the docker network. 
We have provided a `RequestTestCase` class to help you test the customer API.
The controller is called `customer` with both `GET` and `POST` methods. 

#### Examples

#### `GET` /customer

```php
$this->request(
    'GET', 
    'customer', 
    [
        'id' => 1
    ]
);
```

#### `POST` /customer

```php
$this->request(
    'POST', 
    'customer', 
    [], 
    [
        'forename' => 'test',
        'surname' => 'test',
        'email' => 'test@example.com'   
    ]
);
```
