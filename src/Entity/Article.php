<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleImage", mappedBy="article")
     */
    private $articleImages;

    /**
     * @ORM\Column(type="boolean")
     */
    private $frontpage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleVideo", mappedBy="Article")
     */
    private $articleVideos;

    public function __construct()
    {
        $this->articleImages = new ArrayCollection();
        $this->articleVideos = new ArrayCollection();
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|ArticleImage[]
     */
    public function getArticleImages(): Collection
    {
        return $this->articleImages;
    }

    public function addArticleImage(ArticleImage $articleImage): self
    {
        if (!$this->articleImages->contains($articleImage)) {
            $this->articleImages[] = $articleImage;
            $articleImage->setArticle($this);
        }

        return $this;
    }

    public function removeArticleImage(ArticleImage $articleImage): self
    {
        if ($this->articleImages->contains($articleImage)) {
            $this->articleImages->removeElement($articleImage);
            // set the owning side to null (unless already changed)
            if ($articleImage->getArticle() === $this) {
                $articleImage->setArticle(null);
            }
        }

        return $this;
    }

    public function getFrontpage(): ?bool
    {
        return $this->frontpage;
    }

    public function setFrontpage(bool $frontpage): self
    {
        $this->frontpage = $frontpage;

        return $this;
    }

    /**
     * @return Collection|ArticleVideo[]
     */
    public function getArticleVideos(): Collection
    {
        return $this->articleVideos;
    }

    public function addArticleVideo(ArticleVideo $articleVideo): self
    {
        if (!$this->articleVideos->contains($articleVideo)) {
            $this->articleVideos[] = $articleVideo;
            $articleVideo->setArticle($this);
        }

        return $this;
    }

    public function removeArticleVideo(ArticleVideo $articleVideo): self
    {
        if ($this->articleVideos->contains($articleVideo)) {
            $this->articleVideos->removeElement($articleVideo);
            // set the owning side to null (unless already changed)
            if ($articleVideo->getArticle() === $this) {
                $articleVideo->setArticle(null);
            }
        }

        return $this;
    }
}
