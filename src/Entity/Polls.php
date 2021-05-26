<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PollsRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PollsRepository::class)
 */
class Polls
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
    private ?string $title;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    #[Assert\GreaterThan('today')]
    private ?DateTimeInterface $createdDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $publishedDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $finishedDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $answerPublishedDate;

    /**
     * @ORM\OneToMany(targetEntity=Questions::class, mappedBy="polls")
     */
    private $questions;

    public function __construct()
    {
        $this->createdDate = new \DateTime();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getPublishedDate(): ?\DateTimeInterface
    {
        return $this->publishedDate;
    }

    public function setPublishedDate(?\DateTimeInterface $publishedDate): self
    {
            $this->publishedDate = $publishedDate;

            return $this;

    }

    public function getFinishedDate(): ?\DateTimeInterface
    {
        return $this->finishedDate;
    }

    public function setFinishedDate(\DateTimeInterface $finishedDate): self
    {
            $this->finishedDate = $finishedDate;


            return $this;
    }

    public function getAnswerPublishedDate(): ?\DateTimeInterface
    {
        return $this->answerPublishedDate;
    }

    public function setAnswerPublishedDate(\DateTimeInterface $answerPublishedDate): self
    {

            $this->answerPublishedDate = $answerPublishedDate;


        return $this;
    }

    /**
     * @return Collection
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setPolls($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getPolls() === $this) {
                $question->setPolls(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getTitle();
    }
}
