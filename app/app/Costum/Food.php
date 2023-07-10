<?php

namespace App\Costum;

class Food extends Consumable
{
    private $description;
    private $kind;

    public function __construct(string $name, int $price, string $description, string $kind, bool $active) {
        parent::__construct($name, $price, $active);
        $this->description = $description;
        $this->kind = $kind;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getKind(): string {
        return $this->kind;
    }
}
