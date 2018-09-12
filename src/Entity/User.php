<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;
    
    
    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @Assert\NotBlank(message = "Please fill your first name")
     * @Assert\NotNull(message = "Your first name is null")
     * 
     */
    private $first_name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_logged;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_loggin_date;
    
    
    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     * @Assert\NotBlank(message = "Please fill your last name")
     * @Assert\NotNull(message = "Your last name is null")
     */
    private $last_name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreationDate(): \DateTimeInterface
    {
        return $this->creation_date ?? new \DateTime("now");
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->first_name != null ? $this->first_name : "";
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getIsLogged(): bool
    {
        return $this->is_logged ?? false;
    }

    public function setIsLogged(bool $is_logged): self
    {
        $this->is_logged = $is_logged;

        return $this;
    }

    public function getLastLogginDate(): \DateTimeInterface
    {
        return $this->last_loggin_date ?? new \DateTime("now");
    }

    public function setLastLogginDate(\DateTimeInterface $last_loggin_date): self
    {
        $this->last_loggin_date = $last_loggin_date;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->last_name != null ? $this->last_name : "";
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }
}
