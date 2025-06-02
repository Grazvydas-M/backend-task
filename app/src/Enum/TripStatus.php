<?php

namespace App\Enum;

enum TripStatus: string
{
    case TRIP_STARTED = 'started';
    case TRIP_ENDED = 'ended';
    case TRIP_IN_PROGRESS = 'in_progress';
}
