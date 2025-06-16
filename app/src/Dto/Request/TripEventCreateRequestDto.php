<?php

namespace App\Dto\Request;

use App\Entity\Trip;
use App\Enum\TripEventType;
use Symfony\Component\Validator\Constraints as Assert;

class TripEventCreateRequestDto
{
    public function __construct(
        #[Assert\NotNull]
        private readonly Trip $trip,
        private $latitude,
        private $longitude,
        private readonly TripEventType $eventType
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
