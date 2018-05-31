<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
     * @var Banque
     *
     * @ORM\ManyToOne(targetEntity="Banque", inversedBy="compte", fetch="EAGER")
     * @ORM\JoinColumn(name="banque_id", referencedColumnName="id")
     */
    private $banque;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="user")
     */
    private $transaction;

    public function __construct()
    {
        $this->transaction = new ArrayCollection();
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
     * @return Banque
     */
    public function getBanque(): ?Banque
    {
        return $this->banque;
    }

    /**
     * @param Banque $banque
     */
    public function setBanque(Banque $banque)
    {
        $this->banque = $banque;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransaction(): Collection
    {
        return $this->transaction;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transaction->contains($transaction)) {
            $this->transaction[] = $transaction;
            $transaction->setUser($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transaction->contains($transaction)) {
            $this->transaction->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getUser() === $this) {
                $transaction->setUser(null);
            }
        }

        return $this;
    }
}
