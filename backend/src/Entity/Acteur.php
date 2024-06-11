<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ActeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    description: 'Api pour gérer les acteurs d\'un film'
)]
#[ORM\Entity(repositoryClass: ActeurRepository::class)]
class Acteur
{
    private const FEMININ = 'Féminin';
    private const MASCULIN = 'Masculin';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $genre = null;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\OneToMany(targetEntity: Film::class, mappedBy: 'acteur')]
    private Collection $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): static
    {
        if (!$this->films->contains($film)) {
            $this->films->add($film);
            $film->setActeur($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): static
    {
        if ($this->films->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getActeur() === $this) {
                $film->setActeur(null);
            }
        }

        return $this;
    }

    public function getSexe(): string
    {
        return $this->genre === 0 ? self::FEMININ : self::MASCULIN;
    }
}
