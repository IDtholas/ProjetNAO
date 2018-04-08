<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length = 100)
     */
    private $name;

    /**
     * @var= \Datetime
     * @ORM\Column(type="datetime")
     */
    private $observationDate;

    private $coords;

    /**
     * @ORM\Column(type="string")
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     */
    private $observationDescription;

    /**
     * @ORM\ManyToOne(targetEntity="Species", inversedBy="observations")
     */
    private $species;

    /**
     * @ORM\Column(type="boolean", nullable= TRUE)
     */
    private $verified;

    /**
     * @ORM\Column(type="text", nullable= TRUE)
     */
    private $proComment;

    /**
     * @ORM\OneToMany(targetEntity="Comment",mappedBy="observation", cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="observations")
     */
    private $user;

    public function __construct()
    {
        $this->observationDate = new \DateTime();
        $this->comments = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getObservationDate()
    {
        return $this->observationDate;
    }

    /**
     * @param mixed $observationDate
     */
    public function setObservationDate($observationDate): void
    {
        $this->observationDate = $observationDate;
    }

    /**
     * @return mixed
     */
    public function getCoords()
    {
        return $this->coords;
    }

    /**
     * @param mixed $coords
     */
    public function setCoords($coords): void
    {
        $this->coords = $coords;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @param mixed $species
     */
    public function setSpecies($species): void
    {
        $this->species = $species;
    }

    /**
     * @return mixed
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param mixed $verified
     */
    public function setVerified($verified): void
    {
        $this->verified = $verified;
    }

    /**
     * @return mixed
     */
    public function getProComment()
    {
        return $this->proComment;
    }

    /**
     * @param mixed $proComment
     */
    public function setProComment($proComment): void
    {
        $this->proComment = $proComment;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getObservationDescription()
    {
        return $this->observationDescription;
    }

    /**
     * @param mixed $observationDescription
     */
    public function setObservationDescription($observationDescription): void
    {
        $this->observationDescription = $observationDescription;
    }





    // add your own fields
}
