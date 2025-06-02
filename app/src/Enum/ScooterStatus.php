<?php

namespace App\Enum;

enum ScooterStatus: string
{
    case OCCUPIED = 'occupied';
    case FREE_TO_USE = 'free-to-use';
}
