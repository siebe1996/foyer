<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'total_wins',
        'games_played'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    public function teamsAsPlayer1()
    {
        return $this->hasMany(Team::class, 'player1');
    }

    public function teamsAsPlayer2()
    {
        return $this->hasMany(Team::class, 'player2');
    }

    /*public function messages(){
        return $this->hasMany(Message::class);
    }*/

    public function hasRole($role){
        //return false;
        return $this->roles()->where('title', $role)->exists();
    }

    /*public function gamesWithPivot(){
        return $this->belongsToMany(Game::class, 'game_user')->withPivot('game_id', 'user_id', 'kills', 'alive', 'when_killed', 'target_id');
    }*/

    protected function fullName(): Attribute{
        return Attribute::make(
            get: fn ($value, $attributes) => ($attributes['first_name'] . ' ' . $attributes['last_name']),
        );
    }
}
