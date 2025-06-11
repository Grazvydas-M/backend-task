<?php

namespace App\TripEventHandler;


use App\Enum\ScooterStatus;
use App\Enum\TripEventType;
use App\Enum\TripStatus;
use App\Factory\TripEventFactory;
use App\Factory\TripFactory;
use App\Repository\TripEventRepository;
use App\Repository\TripRepository;

readonly class TripEventCreateHandler implements TripEventHandlerInterface
{
    public function __construct(
        private TripFactory $tripFactory,
        private TripEventFactory $tripEventFactory,
        private TripRepository $tripRepository,
        private TripEventRepository $tripEventRepository,
    ) {
    }

    public function supports(TripEventType $eventType): bool
    {
        return $eventType === TripEventType::TRIP_STARTED;
    }

    public function handle($tripEventDto): void
    {
        $tripEvent = $this->tripEventFactory->createFromDto($tripEventDto);
        $trip = $tripEventDto->getTrip();
        $trip->setStatus(TripStatus::STARTED);
        $tripEvent->setTrip($trip);
        $scooter = $trip->getScooter();
        $scooter->setStatus(ScooterStatus::OCCUPIED);

        $this->tripRepository->save($trip);
        $this->tripEventRepository->save($tripEvent, true);
    }
}
