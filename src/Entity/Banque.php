<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BanqueRepository")
 */
class Banque
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="banque", cascade={"persist"})
     */
    private $user;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Compte", mappedBy="banque")
     */
    private $compte;

    /**
     * Banque constructor.
     */
    public function __construct() {
        $this->compte = new ArrayCollection();
        $this->user = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function addUser(User $user) : Banque
    {
        $this->user->add($user);
        return $this;
    }

    /**
     * Remove banque
     *
     * @param User $banque
     */
    public function removeUser(User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return Collection
     */
    public function getUser() : Collection
    {
        return $this->user;
    }

    /**
     * @return ArrayCollection
     */
    public function getCompte(): ArrayCollection
    {
        return $this->compte;
    }

    /**
     * @param ArrayCollection $compte
     */
    public function setCompte(ArrayCollection $compte)
    {
        $this->compte = $compte;
    }
}
