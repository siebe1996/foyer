<?php

namespace App\Models;

use App\Enums\RolesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    protected $casts = [
        'title' => RolesEnum::class
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_role');
    }
}
