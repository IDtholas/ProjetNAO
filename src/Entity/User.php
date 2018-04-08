<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $proof;


    /**
     * @ORM\Column(type="boolean")
     */
    private $validated;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="date", nullable=TRUE)
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="Observation",mappedBy="user")
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;


    public function __construct()
    {
        $this->date = new \DateTime();
        $this->observations = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->validated = 0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles[] =  $roles;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {

        return $this->roles;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param mixed $validated
     */
    public function setValidated($validated): void
    {
        $this->validated = $validated;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }


    /**
     * @param Comment $comment
     * @return $this
     */
    public function addComment(\App\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * @param Comment $comment
     */
    public function removeComment(\App\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Observation $observation
     * @return $this
     */
    public function addObservation(\App\Entity\Observation $observation)
{
    $this->observations[] = $observation;
    return $this;
}

    /**
     * @param Observation $observation
     */
    public function removeObservation(\App\Entity\Observation $observation)
    {
        $this->observations->removeElement($observation);
    }

    /**
     * @return ArrayCollection
     */
    public function getObservations()
    {
        return $this->observations;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * @return mixed
     */
    public function getProof()
    {
        return $this->proof;
    }

    /**
     * @param mixed $proof
     */
    public function setProof($proof): void
    {
        $this->proof = $proof;
    }


}
