<?php

namespace App\Costum;

class Consumable
{
    protected $name;
    protected $price;
    protected $active;

    public function __construct(string $name, float $price, bool $active)
    {
        $this->name = $name;
        $this->price = $price;
        $this->active = $active;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getPrice() : float
    {
        return $this->price;
    }

    public function getActive() : bool
    {
        return $this->active;
    }
}
