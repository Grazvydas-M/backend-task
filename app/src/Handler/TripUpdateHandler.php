<?php

namespace App\Handler;

use App\Dto\Request\TripUpdateRequestDto;
use App\Entity\Trip;
use App\Repository\TripRepository;

readonly class TripUpdateHandler
{
    public function __construct(
        private TripRepository $tripRepository,
    ) {
    }

    public function handle(Trip $trip, TripUpdateRequestDto $tripUpdateRequestDto): void
    {
        $trip->setStatus($tripUpdateRequestDto->getStatus());
        $this->tripRepository->save($trip, true);
    }
}