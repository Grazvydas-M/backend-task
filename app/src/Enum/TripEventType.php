<?php

namespace App\Enum;

enum TripEventType: string
{
    case TRIP_STARTED = 'trip_started';
    case TRIP_ENDED = 'trip_ended';
    case LOCATION_UPDATE = 'location_update';
}
