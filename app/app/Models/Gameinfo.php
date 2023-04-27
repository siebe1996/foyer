<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Gameinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'game_id',
        'goals',
    ];

    /*protected $casts = [
        'goals' => 'integer',
    ];*/

    protected $primaryKey = ['game_id', 'team_id'];
    /*protected function setKeysForSaveQuery($query)
    {
        return $query->where('game_id', $this->getAttribute('game_id'))
            ->where('team_id', $this->getAttribute('team_id'));
    }*/

    //public $incrementing = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
