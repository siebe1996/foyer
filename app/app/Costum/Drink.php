<?php

namespace App\Costum;

class Drink extends Consumable
{
    private $kind;
    private $subkind;

    public function __construct($name, $price, $kind, $subkind) {
        parent::__construct($name, $price);
        $this->kind = $kind;
        $this->subkind = $subkind;
    }

    public function getKind() {
        return $this->kind;
    }

    public function getSubkind() {
        return $this->subkind;
    }
}
