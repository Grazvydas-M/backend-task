<?php

namespace App\TripEventHandler;

use App\Enum\ScooterStatus;
use App\Enum\TripEventType;
use App\Factory\TripEventFactory;
use App\Factory\TripFactory;
use App\Repository\TripEventRepository;
use App\Repository\TripRepository;

readonly class TripEventUpdateHandler implements TripEventHandlerInterface
{
    public function __construct(
        private TripEventFactory $tripEventFactory,
        private TripRepository $tripRepository,
        private TripEventRepository $tripEventRepository,
    ) {
    }

    public function supports(TripEventType $eventType): bool
    {
        return $eventType === TripEventType::LOCATION_UPDATE;
    }

    public function handle($tripEventDto): void
    {
        $tripEvent = $this->tripEventFactory->createFromDto($tripEventDto);
        $trip = $tripEventDto->getTrip();

        $tripEvent->setTrip($trip);
        $scooter = $trip->getScooter();
        $scooter->setStatus(ScooterStatus::OCCUPIED)
            ->setLatitude($tripEventDto->getLatitude())
            ->setLongitude($tripEventDto->getLongitude());

//        $this->tripRepository->save($trip);
        $this->tripEventRepository->save($tripEvent, true);
    }
}
