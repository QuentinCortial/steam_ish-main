<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GamesRepository::class)
 * @ApiResource()
 */
class Games
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiFilter(OrderFilter::class)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @ApiFilter(OrderFilter::class)
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="float")
     * @ApiFilter(OrderFilter::class)
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=Genres::class)
     * @ApiFilter(SearchFilter::class)
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity=Languages::class)
     * @ApiFilter(SearchFilter::class)
     */
    private $languages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbnailCover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbnailLogo;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->languages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Genres[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genres $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genres $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection|Languages[]
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Languages $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages[] = $language;
        }

        return $this;
    }

    public function removeLanguage(Languages $language): self
    {
        $this->languages->removeElement($language);

        return $this;
    }

    public function getThumbnailCover(): ?string
    {
        return $this->thumbnailCover;
    }

    public function setThumbnailCover(?string $thumbnailCover): self
    {
        $this->thumbnailCover = $thumbnailCover;

        return $this;
    }

    public function getThumbnailLogo(): ?string
    {
        return $this->thumbnailLogo;
    }

    public function setThumbnailLogo(?string $thumbnailLogo): self
    {
        $this->thumbnailLogo = $thumbnailLogo;

        return $this;
    }
}
