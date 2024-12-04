<?php

namespace App\Model;

readonly class BrandList
{
    public function __construct(private int    $id,
                                private string $name)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }


}
