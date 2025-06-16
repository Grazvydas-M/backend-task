<?php

namespace App\Dto;

use App\Entity\Trip;
use App\Enum\TripEventType;

readonly class TripEventDto
{
    public function __construct(
        private Trip $trip,
        private float $latitude,
        private float $longitude,
        private TripEventType $eventType
    ) {
    }

    public function getTrip(): Trip
    {
        return $this->trip;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getEventType(): TripEventType
    {
        return $this->eventType;
    }
}
