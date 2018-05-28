<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="Banque", inversedBy="compte")
     * @ORM\JoinColumn(name="banque_id", referencedColumnName="id")
     */
    private $banque;

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
}
