<?php

namespace App\Factory;

use App\Dto\TripEventDto;
use App\Entity\TripEvent;
use DateTimeImmutable;

class TripEventFactory
{
    public function createFromDto(TripEventDto $tripEventDto): TripEvent
    {
        $tripEvent = new TripEvent();
        $tripEvent->setLatitude($tripEventDto->getScooter()->getLatitude())
            ->setLongitude($tripEventDto->getScooter()->getLongitude())
            ->setTime(new DateTimeImmutable())
            ->setEventType($tripEventDto->getType());

        return $tripEvent;
    }
}
