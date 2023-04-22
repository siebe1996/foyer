<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'start_date',
        'end_date',
        'competition_id',
        'winner_id',
        'fooseballtable_id',
    ];

    protected $casts = [
        'active' => 'boolean',
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
    public function fooseballtable(){
        return $this->belongsTo(Fooseballtable::class);
    }

    public function winner()
    {
        return $this->belongsTo(Team::class, 'winner');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'gameinfo')->withPivot('goals');
    }

    public function gameinfo()
    {
        return $this->hasMany(Gameinfo::class, 'game_id');
    }
}
