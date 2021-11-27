<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection; 
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\VideoRepository;

use Doctrine\ORM\Mapping as ORM;




/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
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
     * @ORM\Column(type="datetime")
     */
    private $modifiedat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category; 

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="vid" )
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Basket::class, mappedBy="video", orphanRemoval=true)
     */
    private $baskets;

    
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->baskets = new ArrayCollection();
       
    }

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

    public function getModifiedat(): ?\DateTimeInterface
    {
        return $this->modifiedat;
    }

    public function setModifiedat(\DateTimeInterface $modifiedat): self
    {
        $this->modifiedat = $modifiedat;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setVid($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getVid() === $this) {
                $comment->setVid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Basket[]
     */
    public function getBaskets(): Collection
    {
        return $this->baskets;
    }

    public function addBasket(Basket $basket): self
    {
        if (!$this->baskets->contains($basket)) {
            $this->baskets[] = $basket;
            $basket->setVideo($this);
        }

        return $this;
    }

    public function removeBasket(Basket $basket): self
    {
        if ($this->baskets->contains($basket)) {
            $this->baskets->removeElement($basket);
            // set the owning side to null (unless already changed)
            if ($basket->getVideo() === $this) {
                $basket->setVideo(null);
            }
        }

        return $this;
    }


    

  
}
