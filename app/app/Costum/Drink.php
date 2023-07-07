<?php

namespace App\Costum;

class Drink extends Consumable
{
    private $kind;
    private $subkind;
    private $description;

    public function __construct(string $name, int $price, ?string $description, string $kind, string $subkind) {
        parent::__construct($name, $price);
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
