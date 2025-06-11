<?php

namespace App\Enum;

enum TripStatus: string
{
    case INITIALIZED = 'initialized';
    case STARTED = 'started';
    case ENDED = 'ended';
    case IN_PROGRESS = 'in_progress';
}
