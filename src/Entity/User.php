<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['users_read']],
    denormalizationContext: ['groups' => ['person']]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('users_read')]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups('users_read')]
    private ?string $username = null;

    #[ORM\Column]
    #[Groups('users_read')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups('users_read')]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups('users_read')]
    private ?\DateTimeInterface $inscriptionDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups('users_read')]
    private ?\DateTimeInterface $lastConection = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Shard::class, orphanRemoval: true)]
    private Collection $shards;

    public function __construct()
    {
        $this->shards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getInscriptionDate(): ?\DateTimeInterface
    {
        return $this->inscriptionDate;
    }

    public function setInscriptionDate(\DateTimeInterface $inscriptionDate): static
    {
        $this->inscriptionDate = $inscriptionDate;

        return $this;
    }

    public function getLastConection(): ?\DateTimeInterface
    {
        return $this->lastConection;
    }

    public function setLastConection(?\DateTimeInterface $lastConection): static
    {
        $this->lastConection = $lastConection;

        return $this;
    }

    /**
     * @return Collection<int, Shard>
     */
    public function getShards(): Collection
    {
        return $this->shards;
    }

    public function addShard(Shard $shard): static
    {
        if (!$this->shards->contains($shard)) {
            $this->shards->add($shard);
            $shard->setUser($this);
        }

        return $this;
    }

    public function removeShard(Shard $shard): static
    {
        if ($this->shards->removeElement($shard)) {
            // set the owning side to null (unless already changed)
            if ($shard->getUser() === $this) {
                $shard->setUser(null);
            }
        }

        return $this;
    }
}
