<?php

namespace App\Dto;

use App\Entity\Trip;

readonly class TripEventDto
{
    public function __construct(
        private Trip $trip,
        private float $latitude,
        private float $longitude,
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
}
