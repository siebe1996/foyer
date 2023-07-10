<?php

namespace App\Costum;

class Drink extends Consumable
{
    private $kind;
    private $subkind;
    private $description;

    public function __construct(string $name, float $price, ?string $description, string $kind, string $subkind, bool $active) {
        parent::__construct($name, $price, $active);
        $this->kind = $kind;
        $this->description = $description;
        $this->subkind = $subkind;
    }

    public function getKind(): string {
        return $this->kind;
    }

    public function getSubkind(): string {
        return $this->subkind;
    }

    public function getDescription(): ?string {
        return $this->description;
    }
}
