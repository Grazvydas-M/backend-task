<?php

namespace App\Controller;

use App\Dto\Request\TripEventCreateRequestDto;
use App\Entity\Scooter;
use App\Entity\Trip;
use App\Entity\TripEvent;
use App\Entity\User;
use App\Enum\ScooterStatus;
use App\Enum\TripEventType;
use App\Enum\TripStatus;
use App\Factory\TripEventFactory;
use App\Resolver\TripEventRequestDtoResolver;
use App\TripEventHandler\TripEventHandlerCollection;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly TripEventFactory $tripEventFactory,
        private readonly TripEventHandlerCollection $tripEventHandlerCollection,
    ) {
    }

    #[Route('/trips/{id}/events', name: 'events_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload(
            resolver: TripEventRequestDtoResolver::class,
        )] TripEventCreateRequestDto $tripEventCreateRequestDto
    ): Response {
        $tripEventDto = $this->tripEventFactory->createRequestDto($tripEventCreateRequestDto);
        $tripEvent = $this->tripEventFactory->createFromDto($tripEventDto);

        foreach ($this->tripEventHandlerCollection->all() as $tripEventHandler) {
            if ($tripEventHandler->supports($tripEvent->getEventType())) {
                $tripEventHandler->handle($tripEventDto);
            }
        }

        return $this->json([], Response::HTTP_CREATED);
    }

    #[Route('/event', name: 'event')]
    public function logEvent(): Response
    {
        // Create User
        $user = new User();
        $this->em->persist($user);

        // Create Scooter
        $scooter = new Scooter();
        $scooter->setLatitude(50.06143)
            ->setLongitude(19.93658)
            ->setStatus(ScooterStatus::FREE_TO_USE) // Adjust according to your enum
            ->setUser($user);
        $this->em->persist($scooter);

        // Create Trip
        $trip = new Trip();
        $trip->setUser($user)
            ->setScooter($scooter)
            ->setStartedAt(new DateTimeImmutable())
            ->setStatus(TripStatus::IN_PROGRESS); // Adjust enum
        $this->em->persist($trip);

        // Create TripEvent
        $tripEvent = new TripEvent();
        $tripEvent->setLatitude(50.06143)
            ->setLongitude(19.93658)
            ->setTime(new DateTimeImmutable())
            ->setEventType(TripEventType::TRIP_STARTED)
            ->setTrip($trip);
        $this->em->persist($tripEvent);

        // Save all
        $this->em->flush();

        return new Response('Event endpoint is working!');
    }
}
