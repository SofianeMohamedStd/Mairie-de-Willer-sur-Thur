<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotBlank]
    private ?string $wording;

    /**
     * @ORM\Column(type="boolean")
     */
    #[Assert\Type('boolean')]
    private ?bool $multipleChoice;

    /**
     * @ORM\ManyToOne(targetEntity=Polls::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Polls $polls;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="questions")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=Choices::class, mappedBy="question_id")
     */
    private $choices;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->choices = new ArrayCollection();
    }

    #[Pure] public function __toString(): string
    {
        return $this->getWording();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getMultipleChoice(): ?bool
    {
        return $this->multipleChoice;
    }

    public function setMultipleChoice(bool $multipleChoice): self
    {
        $this->multipleChoice = $multipleChoice;

        return $this;
    }

    public function getPolls(): ?Polls
    {
        return $this->polls;
    }

    public function setPolls(?Polls $polls): self
    {
        $this->polls = $polls;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestions($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestions() === $this) {
                $answer->setQuestions(null);
            }
        }

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
            $choice->setQuestionId($this);
        }

        return $this;
    }

    public function removeChoice(Choices $choice): self
    {
        if ($this->choices->removeElement($choice)) {
            // set the owning side to null (unless already changed)
            if ($choice->getQuestionId() === $this) {
                $choice->setQuestionId(null);
            }
        }

        return $this;
    }



}
