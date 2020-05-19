<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="Un autre utilisateur s'est déjà inscrit avec cette adresse email"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Veuillez renseigner un email valide !")
     */
    private $email;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire plus de 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas correctement confirmé votre mot de passe")
     */
    private $passwordConfirm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="User")
     */
    private $projects;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SprintGroup", inversedBy="user_id")
     */
    private $sprintGroup;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStories", mappedBy="user_id")
     */
    private $userStories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", mappedBy="contributor")
     */
    private $contributors;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $initials;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $color;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->projects = new ArrayCollection();
        $this->userStories = new ArrayCollection();
        $this->contributors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt()
    {
        //
    }

    public function eraseCredentials()
    {
        //
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getPasswordConfirm(): ?string
    {
        return $this->passwordConfirm;
    }

    public function setPasswordConfirm(string $passwordConfirm): self
    {
        $this->passwordConfirm = $passwordConfirm;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setUser($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getUser() === $this) {
                $project->setUser(null);
            }
        }

        return $this;
    }

    public function getSprintGroup(): ?SprintGroup
    {
        return $this->sprintGroup;
    }

    public function setSprintGroup(?SprintGroup $sprintGroup): self
    {
        $this->sprintGroup = $sprintGroup;

        return $this;
    }

    /**
     * @return Collection|UserStories[]
     */
    public function getUserStories(): Collection
    {
        return $this->userStories;
    }

    public function addUserStory(UserStories $userStory): self
    {
        if (!$this->userStories->contains($userStory)) {
            $this->userStories[] = $userStory;
            $userStory->setUserId($this);
        }

        return $this;
    }

    public function removeUserStory(UserStories $userStory): self
    {
        if ($this->userStories->contains($userStory)) {
            $this->userStories->removeElement($userStory);
            // set the owning side to null (unless already changed)
            if ($userStory->getUserId() === $this) {
                $userStory->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getContributors(): Collection
    {
        return $this->contributors;
    }

    public function addContributor(Project $contributor): self
    {
        if (!$this->contributors->contains($contributor)) {
            $this->contributors[] = $contributor;
            $contributor->addContributor($this);
        }

        return $this;
    }

    public function removeContributor(Project $contributor): self
    {
        if ($this->contributors->contains($contributor)) {
            $this->contributors->removeElement($contributor);
            $contributor->removeContributor($this);
        }

        return $this;
    }

    public function getInitials(): ?string
    {
        return $this->initials;
    }

    public function setInitials(?string $initials): self
    {
        $this->initials = $initials;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
