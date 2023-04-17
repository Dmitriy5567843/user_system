<?php
declare(strict_types=1);

namespace App\DTO;


final class CreateUserDTO
{
    /**
     * @var string name.
     */
    private string $name;

    /**
     * @var string email.
     */
    private string $email;

    /**
     * @var string password.
     */
    private string $password;

    /**
     * @var ?string role.
     */
    private ?string $role;

    /**
     * @var ?string description.
     */
    private ?string $description;


    /**
     * CreateUserDTO constructor.
     *
     * @param  string  $name
     * @param  string  $email
     * @param  string  $password
     * @param  ?string  $role
     * @param  ?string  $description
     */
    public function __construct(string $name, string $email, string $password, ?string $role, ?string $description)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->description = $description;
    }

    /**
     * @return string
     * @see CreateUserDTO::$name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @see CreateUserDTO::$email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     * @see CreateUserDTO::$password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return ?string
     * @see CreateUserDTO::$role
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @return ?string
     * @see CreateUserDTO::$description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
