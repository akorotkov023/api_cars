<?php

namespace App\Entity;

use App\Repository\CreditProgramRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditProgramRepository::class)]
class CreditProgram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $interestRate = null;

    #[ORM\Column]
    private ?int $maxLoanTerm = null;

    #[ORM\Column]
    private ?int $minInitialPayment = null;

    #[ORM\OneToMany(targetEntity: Credit::class, mappedBy: "programId")]
    private Collection $credits;

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

    public function getInterestRate(): ?int
    {
        return $this->interestRate;
    }

    public function setInterestRate(string $interestRate): self
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function getMaxLoanTerm(): ?int
    {
        return $this->maxLoanTerm;
    }

    public function setMaxLoanTerm(int $maxLoanTerm): self
    {
        $this->maxLoanTerm = $maxLoanTerm;

        return $this;
    }

    public function getMinInitialPayment(): ?int
    {
        return $this->minInitialPayment;
    }

    public function setMinInitialPayment(int $minInitialPayment): self
    {
        $this->minInitialPayment = $minInitialPayment;

        return $this;
    }
}
