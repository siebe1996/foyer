<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'winaar',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function winaar()
    {
        return $this->belongsTo(Team::class, 'winaar');
    }
}
