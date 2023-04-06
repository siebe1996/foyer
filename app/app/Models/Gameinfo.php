<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gameinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'game_id',
        'goals',
    ];

    protected $primaryKey = ['game_id', 'team_id'];

    public $incrementing = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
