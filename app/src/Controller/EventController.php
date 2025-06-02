<?php

namespace App\Controller;

use App\Entity\Scooter;
use App\Entity\Trip;
use App\Entity\TripEvent;
use App\Entity\User;
use App\Enum\ScooterStatus;
use App\Enum\TripStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
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
            ->setDuration(new \DateTimeImmutable()) // Replace with real duration if needed
            ->setStatus(TripStatus::TRIP_IN_PROGRESS); // Adjust enum
        $this->em->persist($trip);

        // Create TripEvent
        $tripEvent = new TripEvent();
        $tripEvent->setLatitude(50.06143)
            ->setLongitude(19.93658)
            ->setTime(new \DateTime())
            ->setTrip($trip);
        $this->em->persist($tripEvent);

        // Save all
        $this->em->flush();

        return new Response('Event endpoint is working!');
    }
}
