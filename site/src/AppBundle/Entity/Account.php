<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Food;
    

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Account", mappedBy="recipientsAccount")
     */
    private $linkedAccounts;

    public function __construct()
    {
        $this->linkedAccounts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(string $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getColor(): string
    {
        return $this->Color;
    }

    public function setColor(string $Color): self
    {
        $this->Color = $Color;

        return $this;
    }

    public function getFood(): string
    {
        return $this->Food;
    }

    public function setFood(string $Food): self
    {
        $this->Food = $Food;

        return $this;
    }




    

    /**
     * @return Collection|Account[]
     */
    public function getLinkedAccounts(): Collection
    {
        return $this->linkedAccounts;
    }

    public function addLinkedAccount(Account $linkedAccount): self
    {
        if (!$this->linkedAccounts->contains($linkedAccount)) {
            $this->linkedAccounts[] = $linkedAccount;
            $linkedAccount->addRecipientsAccount($this);
        }

        return $this;
    }

    public function removeLinkedAccount(Account $linkedAccount): self
    {
        if ($this->linkedAccounts->contains($linkedAccount)) {
            $this->linkedAccounts->removeElement($linkedAccount);
            $linkedAccount->removeRecipientsAccount($this);
        }

        return $this;
    }
}
