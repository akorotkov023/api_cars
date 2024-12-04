<?php

namespace App\Model;


class BaseCarDetails
{
    private int $id;

    /**
     * @var BrandList[]
     */
    private array $brand;

    /**
     * @var BrandList[]
     */
    private array $model;

    private ?string $photo = null;
    private int $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getBrand(): ?array
    {
        return $this->brand;
    }

    public function setBrand(array $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): array
    {
        return $this->model;
    }

    public function setModel(array $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
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
