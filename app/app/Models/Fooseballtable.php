<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fooseballtable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
