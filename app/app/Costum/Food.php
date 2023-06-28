<?php

namespace App\Costum;

class Food extends Consumable
{
    private $description;
    private $kind;

    public function __construct($name, $price, $description, $kind) {
        parent::__construct($name, $price);
        $this->description = $description;
        $this->kind = $kind;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getKind() {
        return $this->kind;
    }
}
