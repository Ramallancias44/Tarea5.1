<?php

namespace App\Entity;

use App\Repository\JugadorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JugadorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Jugador
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    private ?string $nombre = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Range(min: 0.01, max: 999.99)]
    private ?float $altura = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThan(
        value: 0,
        message: 'El número debe ser mayor que 0'
    )]
    
    private ?int $dorsal = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $crear = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $actualizar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAltura(): ?float
    {
        return $this->altura;
    }

    public function setAltura(float $altura): static
    {
        $this->altura = $altura;

        return $this;
    }

    public function getDorsal(): ?int
    {
        return $this->dorsal;
    }

    public function setDorsal(int $dorsal): static
    {
        $this->dorsal = $dorsal;

        return $this;
    }

    public function getCrear(): ?\DateTimeInterface
    {
        return $this->crear;
    }
    #[ORM\PrePersist]

    public function setCrear(): self
    {
        $this->crear = new DateTimeImmutable('now');

        return $this;
    }

    public function getActualizar(): ?\DateTimeInterface
    {
        return $this->actualizar;
    }
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setActualizar(): self
    {
        $this->actualizar = new DateTimeImmutable('now');

        return $this;
    }
}
