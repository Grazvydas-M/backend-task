<?php

namespace App\Factory;

use App\Dto\Request\TripEventCreateRequestDto;
use App\Dto\TripEventDto;
use App\Entity\TripEvent;
use App\Enum\TripEventType;
use DateTimeImmutable;

class TripEventFactory
{
    public function createRequestDto(TripEventCreateRequestDto $tripEventCreateRequestDto): TripEventDto
    {
        return new TripEventDto(
            $tripEventCreateRequestDto->getTrip(),
            $tripEventCreateRequestDto->getLatitude(),
            $tripEventCreateRequestDto->getLongitude(),
            $tripEventCreateRequestDto->getEventType()
        );
    }

    public function createFromDto(TripEventDto $tripEventDto): TripEvent
    {
        $tripEvent = new TripEvent();
        $tripEvent->setLatitude($tripEventDto->getLatitude())
            ->setLongitude($tripEventDto->getLongitude())
            ->setTime(new DateTimeImmutable())
            ->setEventType($tripEventDto->getEventType());

        return $tripEvent;
    }
}
