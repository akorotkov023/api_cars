<?php

namespace App\Entity;

use App\Repository\CreditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditRepository::class)]
class Credit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Car::class, fetch: "EAGER", inversedBy: "cars")]
    #[ORM\JoinColumn(name: "car_id", referencedColumnName: "id")]
    private Car $carId;

    #[ORM\ManyToOne(targetEntity: CreditProgram::class, fetch: "EAGER", inversedBy: "credits")]
    #[ORM\JoinColumn(name: "program_id", referencedColumnName: "id")]
    private CreditProgram $programId;

    #[ORM\Column]
    private ?int $initialPayment = null;

    #[ORM\Column]
    private ?int $loanTerm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarId(): ?Car
    {
        return $this->carId;
    }

    public function setCarId(Car $carId): self
    {
        $this->carId = $carId;

        return $this;
    }

    public function getProgramId(): CreditProgram
    {
        return $this->programId;
    }

    public function setProgramId(CreditProgram $programId): self
    {
        $this->programId = $programId;

        return $this;
    }

    public function getInitialPayment(): ?int
    {
        return $this->initialPayment;
    }

    public function setInitialPayment(int $initialPayment): self
    {
        $this->initialPayment = $initialPayment;

        return $this;
    }

    public function getLoanTerm(): ?int
    {
        return $this->loanTerm;
    }

    public function setLoanTerm(int $loanTerm): self
    {
        $this->loanTerm = $loanTerm;

        return $this;
    }
}
