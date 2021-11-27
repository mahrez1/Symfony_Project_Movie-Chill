<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BasketRepository::class)
 */
class Basket
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

   /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\File(
     *     mimeTypes = {"image/png",
     *          "image/jpeg",
     *           "image/jpg",
     *          "image/gif"},
     *     mimeTypesMessage = "Please upload a valid Image File"
     * )
     */
    private $cover;

    /**
     *  @ORM\Column(type="string", length=255)
     * * @Assert\File(
     *     mimeTypes = {"video/mp4", "video/quicktime", "video/avi"},
     *     mimeTypesMessage = "Please upload a valid Video File"
     * )
     */
    private $content;

    /** 
     * @ORM\Column(type="datetime")
     */
    private $addedat;

    /**
     * @ORM\ManyToOne(targetEntity="User" ,inversedBy="baskets")
     * @ORM\JoinColumn(name="user_id" ,referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;

   /**
     * @ORM\ManyToOne(targetEntity="Video" ,inversedBy="baskets")
     * @ORM\JoinColumn(name="video_id" ,referencedColumnName="id",onDelete="CASCADE")
     */
    private $video;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAddedat(): ?\DateTimeInterface
    {
        return $this->addedat;
    }

    public function setAddedat(\DateTimeInterface $addedat): self
    {
        $this->addedat = $addedat;

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

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }
}
