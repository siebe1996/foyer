<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['active', 'start_date', 'end_date', 'weapon_id'];

    public function users(){
        return $this->belongsToMany(User::class, 'game_user');
    }

    public function usersWithPivot(){
        return $this->belongsToMany(User::class, 'game_user')->withPivot('game_id', 'user_id', 'kills', 'alive', 'when_killed', 'target_id');
    }

    public function weapon(){
        return $this->belongsTo(Weapon::class);
    }
}
