<?php
//
//namespace App\TripEventHandler;
//
//use App\Dto\TripDto;
//use App\Enum\ScooterStatus;
//use App\Enum\TripEventType;
//use App\Factory\TripEventFactory;
//use App\Factory\TripFactory;
//use App\Repository\TripEventRepository;
//use App\Repository\TripRepository;
//
//readonly class TripEventUpdateHandler implements TripEventHandlerInterface
//{
//    public function __construct(
//        private TripFactory $tripFactory,
//        private TripEventFactory $tripEventFactory,
//        private TripRepository $tripRepository,
//        private TripEventRepository $tripEventRepository,
//    ) {
//    }
//
//    public function supports(TripEventType $eventType): bool
//    {
//        return $eventType === TripEventType::LOCATION_UPDATE;
//    }
//
//    public function handle(TripDto $tripEventDto): void
//    {
//
//        $tripEvent = $this->tripEventFactory->createFromDto($tripEventDto);
//
//
//        $tripEvent->setTrip($trip);
//        $scooter = $trip->getScooter();
//        $scooter->setStatus(ScooterStatus::OCCUPIED)
//            ->setLatitude()
//            ->setLongitude();
//
//
//        $this->tripRepository->save($trip);
//        $this->tripEventRepository->save($tripEvent, true);
//    }
//}
