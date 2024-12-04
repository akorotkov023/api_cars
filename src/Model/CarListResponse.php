<?php

namespace App\Model;

readonly class CarListResponse
{
    /**
     * @param CarListItem[] $items
     */
    public function __construct(private array $items)
    {
    }

    /**
     * @return CarListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

}
