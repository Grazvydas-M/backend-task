<?php

namespace App\Factory;

use App\Dto\TripEventDto;
use App\Entity\Trip;
use App\Enum\TripStatus;
use DateTimeImmutable;

class TripFactory
{
    public function createFromDto(TripEventDto $tripEventDto): Trip
    {
        $trip = new Trip();
        $trip->setUser($tripEventDto->getUser())
            ->setScooter($tripEventDto->getScooter())
            ->setStartedAt(new DateTimeImmutable())
            ->setStatus(TripStatus::STARTED);

        return $trip;
    }
}
