<?php

namespace App\Entity;

use App\Entity\Interfaces\CommentInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment implements CommentInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var = \Datetime
     * @ORM\Column(type="datetime")
     */
    private $commentDate;

    /**
     * @ORM\Column(type="text")
     */
    private $commentContent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $moderate;

    /**
     * @ORM\ManyToOne(targetEntity="Observation", inversedBy="comments")
     */
    private $observation;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="comments")
     */
    private $user;

    public function __construct()
    {
        $this->commentDate = new \Datetime();
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
     * @param mixed $commentAutor
     */
    public function setCommentAutor($commentAutor): void
    {
        $this->commentAutor = $commentAutor;
    }

    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * @param mixed $commentDate
     */
    public function setCommentDate($commentDate): void
    {
        $this->commentDate = $commentDate;
    }

    /**
     * @return mixed
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * @param mixed $commentContent
     */
    public function setCommentContent($commentContent): void
    {
        $this->commentContent = $commentContent;
    }

    /**
     * @return mixed
     */
    public function getModerate()
    {
        return $this->moderate;
    }

    /**
     * @param mixed $moderate
     */
    public function setModerate($moderate): void
    {
        $this->moderate = $moderate;
    }

    /**
     * @return mixed
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param mixed $observation
     */
    public function setObservation($observation): void
    {
        $this->observation = $observation;
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


}
