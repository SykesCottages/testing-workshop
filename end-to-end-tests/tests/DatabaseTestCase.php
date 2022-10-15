<?php declare(strict_types=1);

namespace SykesCottages\Tests;

use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use mysqli;
use PHPUnit\Framework\TestCase;

abstract class DatabaseTestCase extends TestCase
{
    protected Container $applicationContainer;
    private mysqli $database;

    /**
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function setUp(): void
    {
        $this->applicationContainer = (new ContainerBuilder())
            ->addDefinitions(__DIR__ . '/../definitions.php')
            ->build();

        $this->database = $this->applicationContainer->get('mysqli');
    }

    /**
     * @param string $tableName
     * @return void
     */
    protected function truncateTable(string $tableName): void
    {
        $this->database->query("TRUNCATE TABLE `${tableName}`");
    }

    /**
     * @return array
     */
    public function seedData(): array {
        return [];
    }

    /**
     * @return void
     */
    protected function runSeedData(): void
    {
        $seedData = $this->seedData();
        foreach($seedData as $tableName => $data)
        {
            foreach($data as $row) {
                $columnNames = implode('`, `', array_keys($row));
                $values = implode('", "', array_values($row));
                $query = "INSERT INTO ${tableName} (`${columnNames}`) VALUES (\"${values}\");";
                $this->database->query($query);
            }
        }
    }
}
