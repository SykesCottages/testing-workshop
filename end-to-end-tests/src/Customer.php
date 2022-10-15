<?php declare(strict_types=1);

namespace SykesCottages\TestingWorkshop;

use JsonSerializable;

class Customer implements JsonSerializable
{
    const MAX_FORENAME_LENGTH = 1024;
    const MAX_SURNAME_LENGTH = 1024;
    const MAX_EMAIL_LENGTH = 1024;

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

    public function jsonSerialize(): object
    {
        return (object)[
            'id' => $this->id,
            'forename' => $this->forename,
            'surname' => $this->surname,
            'email' => $this->email
        ];
    }
}
