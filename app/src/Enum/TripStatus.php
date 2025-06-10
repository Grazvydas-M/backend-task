<?php

namespace App\Enum;

enum TripStatus: string
{
    case STARTED = 'started';
    case ENDED = 'ended';
    case IN_PROGRESS = 'in_progress';
}
