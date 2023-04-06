<?php

namespace App\Enums;

enum RolesEnum:string
{
    case PLAYER = 'player';
    case MODERATOR = 'moderator';
    case ADMINISTRATOR = 'administrator';
}
