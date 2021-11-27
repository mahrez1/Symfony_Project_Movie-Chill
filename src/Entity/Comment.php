<?php

namespace App\Entity; 

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;  

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */ 
    private $addedat;
 
    /**
     * @ORM\ManyToOne(targetEntity="Video" ,inversedBy="comments")
     * @ORM\JoinColumn(name="vid_id" ,referencedColumnName="id",onDelete="CASCADE")
     */
    private $vid;

    /**
     * @ORM\ManyToOne(targetEntity="User" ,inversedBy="comments")
     * @ORM\JoinColumn(name="user_id" ,referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getAddedat(): ?\DateTimeInterface
    {
        return $this->addedat;
    }

    public function setAddedat(?\DateTimeInterface $addedat): self
    {
        $this->addedat = $addedat;

        return $this;
    }

    public function getVid(): ?Video
    {
        return $this->vid;
    }

    public function setVid(?Video $vid): self
    {
        $this->vid = $vid;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
