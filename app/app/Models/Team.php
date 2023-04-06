<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'player1',
        'player2',
        'total_wins',
        'games_played'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function player1(){
        return $this->belongsTo(User::class, 'player1' );
    }

    public function player2(){
        return $this->belongsTo(User::class, 'player2' );
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function gameinfo(){
        return $this->hasMany(Gameinfo::class, 'game_id');
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, 'gameinfo')->withPivot('goals');
    }

}
