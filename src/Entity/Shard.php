<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ShardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShardRepository::class)]
#[ApiResource]
class Shard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'shardid', targetEntity: Pnj::class, orphanRemoval: true)]
    private Collection $pnjs;

    #[ORM\ManyToOne(inversedBy: 'shards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->pnjs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Pnj>
     */
    public function getPnjs(): Collection
    {
        return $this->pnjs;
    }

    public function addPnj(Pnj $pnj): static
    {
        if (!$this->pnjs->contains($pnj)) {
            $this->pnjs->add($pnj);
            $pnj->setShardid($this);
        }

        return $this;
    }

    public function removePnj(Pnj $pnj): static
    {
        if ($this->pnjs->removeElement($pnj)) {
            // set the owning side to null (unless already changed)
            if ($pnj->getShardid() === $this) {
                $pnj->setShardid(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
