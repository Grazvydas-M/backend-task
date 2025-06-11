<?php

namespace App\Factory;

use App\Dto\Request\TripCreateRequestDto;
use App\Dto\Response\TripCreateResponseDto;
use App\Dto\TripDto;
use App\Entity\Trip;
use App\Enum\TripStatus;
use App\Repository\TripRepository;
use DateTimeImmutable;

readonly class TripFactory
{
    public function __construct(
        private TripRepository $tripRepository,
    ) {
    }

    public function createRequestDto(TripCreateRequestDto $tripRequestDto): TripDto
    {
        $user = $tripRequestDto->getUser();
        $scooter = $tripRequestDto->getScooter();

        return new TripDto(
            $user,
            $scooter,
        );
    }

    public function createFromDto(TripDto $tripEventDto): Trip
    {
        $trip = new Trip();
        $trip->setUser($tripEventDto->getUser())
            ->setScooter($tripEventDto->getScooter())
            ->setStartedAt(new DateTimeImmutable())
            ->setStatus(TripStatus::INITIALIZED);

        $this->tripRepository->save($trip, true);

        return $trip;
    }

    public function createResponseDto(Trip $trip): TripCreateResponseDto
    {
        return new TripCreateResponseDto(
            $trip->getId(),
        );
    }
}
