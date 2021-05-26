<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ParticipationRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    #[Assert\GreaterThan('today')]
    private ?DateTimeInterface $createdDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="participations")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Polls::class)
     */
    private $poll_id;

    /**
     * @ORM\OneToMany(targetEntity=Choices::class, mappedBy="participation_id")
     */
    private $choices;


    public function __construct()
    {
        $this->createdDate = new \DateTime();
        $this->choices = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedDate(): ?DateTimeInterface
    {
        return $this->createdDate;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPollId(): ?Polls
    {
        return $this->poll_id;
    }

    public function setPollId(?Polls $poll_id): self
    {
        $this->poll_id = $poll_id;

        return $this;
    }

    /**
     * @return Collection|Choices[]
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choices $choice): self
    {
        if (!$this->choices->contains($choice)) {
            $this->choices[] = $choice;
            $choice->setParticipationId($this);
        }

        return $this;
    }

    public function removeChoice(Choices $choice): self
    {
        if ($this->choices->removeElement($choice)) {
            // set the owning side to null (unless already changed)
            if ($choice->getParticipationId() === $this) {
                $choice->setParticipationId(null);
            }
        }

        return $this;
    }


}
