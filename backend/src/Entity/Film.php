<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\FilmRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    description: 'Api pour ajouter,lister,modifier, supprimer les films',
    normalizationContext: ['groups' => ['film:read']],
    denormalizationContext: ['groups' => ['film:write']],
    operations: [
        new Post(
            normalizationContext: ['groups' => ['film:item:read']]
        ),
        new GetCollection(
            normalizationContext: ['groups' => ['film:collection:read']]
        ),
        new Get(),
        new Put(),
        new Delete()
    ]
)]
#[ORM\Entity(repositoryClass: FilmRepository::class)]
#[ApiFilter(SearchFilter::class, properties: ['genre'], strategy: 'partial')]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['film:collection:read','film:item:read','film:write'])]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['film:collection:read', 'film:item:read','film:write'])]
    private ?\DateTimeInterface $dateDeSortie = null;

    #[ORM\Column(length: 255)]
    #[Groups(['film:item:read','film:write'])]
    private ?string $resume = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['film:item:read','film:write'])]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'films')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['film:collection:read', 'film:item:read'])]
    private ?Genre $genre = null;

    #[ORM\ManyToOne(inversedBy: 'films')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['film:item:read'])]
    private ?Acteur $acteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateDeSortie(): ?\DateTimeInterface
    {
        return $this->dateDeSortie;
    }

    public function setDateDeSortie(?\DateTimeInterface $dateDeSortie): static
    {
        $this->dateDeSortie = $dateDeSortie;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getActeur(): ?Acteur
    {
        return $this->acteur;
    }

    public function setActeur(?Acteur $acteur): static
    {
        $this->acteur = $acteur;

        return $this;
    }
}
