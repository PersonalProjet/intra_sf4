<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $facebookID;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_access_token", type="text")
     */
    protected $facebook_access_token;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="text")
     */
    protected $picture;

    /**
     * @var Banque
     *
     * @ORM\ManyToMany(targetEntity="Banque")
     * @ORM\JoinTable(name="user_banque",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="banque_id", referencedColumnName="id")}
     *      )
     */
    protected $banque;

    public function __construct()
    {
        parent::__construct();
        $this->banque = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @param int $id
     */
    public function setId($id) : int
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFacebookID() : string
    {
        return $this->facebookID;
    }

    /**
     * @param string $facebookID
     */
    public function setFacebookID(string $facebookID)
    {
        $this->facebookID = $facebookID;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken() : string
    {
        return $this->facebook_access_token;
    }

    /**
     * @param string $facebook_access_token
     */
    public function setFacebookAccessToken(string $facebook_access_token)
    {
        $this->facebook_access_token = $facebook_access_token;
    }

    /**
     * @return string
     */
    public function getPicture() : string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired() : bool
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked() : bool
    {
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired() : bool
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled() : bool
    {
        return true;
    }

    /**
     * Add banque
     *
     * @param Banque $banque
     *
     * @return User
     */
    public function addBanque(Banque $banque) : Banque
    {
        $this->banque[] = $banque;

        return $this;
    }
    /**
     * Remove banque
     *
     * @param Banque $banque
     */
    public function removeBanque(Banque $banque)
    {
        $this->banque->removeElement($banque);
    }

    /**
     * Get banque
     *
     * @return Collection
     */
    public function getBanque() : Collection
    {
        return $this->banque;
    }
}
