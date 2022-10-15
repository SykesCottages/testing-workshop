<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

class Customer
{
    private int $id;
    private string $forename;
    private string $surname;
    private string $email;

    /**
     * @param string $forename
     * @param string $surname
     * @param string $email
     */
    public function __construct(string $forename, string $surname, string $email)
    {
        $this->forename = $forename;
        $this->surname = $surname;
        $this->email = $email;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getForename(): string
    {
        return $this->forename;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
