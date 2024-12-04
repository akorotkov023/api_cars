<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ORM\Table(name: 'cars')]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Brand::class, fetch: "EAGER", inversedBy: "brands")]
    #[ORM\JoinColumn(name: 'brand_id', referencedColumnName: 'id', nullable: false)]
    private Brand $brandId;

    #[ORM\ManyToOne(targetEntity: Model::class, fetch: "EAGER", inversedBy: "models")]
    #[ORM\JoinColumn(name: 'model_id', referencedColumnName: 'id', nullable: false)]
    private Model $modelId;

    #[ORM\Column(type: 'string')]
    private string $photo;

    #[ORM\Column(type: 'integer')]
    private int $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getBrand(): Brand
    {
        return $this->brandId;
    }
    public function setBrand(Brand $brandId): self
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function getModel(): Model
    {
        return $this->modelId;
    }

    public function setModel(Model $modelId): self
    {
        $this->modelId = $modelId;

        return $this;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }



}
