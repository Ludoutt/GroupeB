<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BacklogProduct", mappedBy="project")
     */
    private $backlogProducts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="contributors")
     */
    private $contributor;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->backlogProducts = new ArrayCollection();
        $this->contributor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedby(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedby(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|BacklogProduct[]
     */
    public function getBacklogProducts(): Collection
    {
        return $this->backlogProducts;
    }

    public function addBacklogProduct(BacklogProduct $backlogProduct): self
    {
        if (!$this->backlogProducts->contains($backlogProduct)) {
            $this->backlogProducts[] = $backlogProduct;
            $backlogProduct->setProject($this);
        }

        return $this;
    }

    public function removeBacklogProduct(BacklogProduct $backlogProduct): self
    {
        if ($this->backlogProducts->contains($backlogProduct)) {
            $this->backlogProducts->removeElement($backlogProduct);
            // set the owning side to null (unless already changed)
            if ($backlogProduct->getProject() === $this) {
                $backlogProduct->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getContributor(): Collection
    {
        return $this->contributor;
    }

    public function addContributor(User $contributor): self
    {
        if (!$this->contributor->contains($contributor)) {
            $this->contributor[] = $contributor;
        }

        return $this;
    }

    public function removeContributor(User $contributor): self
    {
        if ($this->contributor->contains($contributor)) {
            $this->contributor->removeElement($contributor);
        }

        return $this;
    }
}
