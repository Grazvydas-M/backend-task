<?php

namespace App\TripEventHandler;

use App\Dto\TripEventDto;
use App\Enum\ScooterStatus;
use App\Enum\TripEventType;
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

    public function handle(TripEventDto $tripEventDto): void
    {
        $trip = $this->tripFactory->createFromDto($tripEventDto);
        $tripEvent = $this->tripEventFactory->createFromDto($tripEventDto);

        $tripEvent->setTrip($trip);
        $scooter = $trip->getScooter();
        $scooter->setStatus(ScooterStatus::OCCUPIED);

        $this->tripRepository->save($trip);
        $this->tripEventRepository->save($tripEvent, true);
    }
}
