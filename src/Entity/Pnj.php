<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PnjRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PnjRepository::class)]
#[ApiResource]
class Pnj
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: PnjData::class, mappedBy: 'pnjs')]
    private Collection $pnjData;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?int $honor = null;

    #[ORM\ManyToOne(inversedBy: 'pnjs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shard $shardid = null;

    public function __construct()
    {
        $this->pnjData = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PnjData>
     */
    public function getPnjData(): Collection
    {
        return $this->pnjData;
    }

    public function addPnjData(PnjData $pnjData): static
    {
        if (!$this->pnjData->contains($pnjData)) {
            $this->pnjData->add($pnjData);
            $pnjData->addPnj($this);
        }

        return $this;
    }

    public function removePnjData(PnjData $pnjData): static
    {
        if ($this->pnjData->removeElement($pnjData)) {
            $pnjData->removePnj($this);
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getHonor(): ?int
    {
        return $this->honor;
    }

    public function setHonor(int $honor): static
    {
        $this->honor = $honor;

        return $this;
    }

    public function getShardid(): ?Shard
    {
        return $this->shardid;
    }

    public function setShardid(?Shard $shardid): static
    {
        $this->shardid = $shardid;

        return $this;
    }
}
