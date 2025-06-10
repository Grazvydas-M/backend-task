<?php

namespace App\Controller;

use App\Dto\Request\TripEventRequestDto;
use App\Dto\TripEventDto;
use App\Resolver\TripEventRequestDtoResolver;
use App\TripEventHandler\TripEventHandlerCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class TripsController extends AbstractController
{
    public function __construct(
        private readonly TripEventHandlerCollection $tripEventHandlerCollection,
    ) {
    }

    #[Route('/trips', name: 'trips_index', methods: ['GET'])]
    public function index(): Response
    {


//        list of trips
        return new Response('Event endpoint is working!');
    }

    #[Route('/trips/event', name: 'trips_event', methods: ['POST'])]
    public function create(
        #[MapRequestPayload(
            resolver: TripEventRequestDtoResolver::class
        )] TripEventRequestDto $tripEventRequestDto
    ): Response {
        $user = $tripEventRequestDto->getUser();
        $scooter = $tripEventRequestDto->getScooter();

        $tripEventDto = new TripEventDto(
            $user,
            $scooter,
            $tripEventRequestDto->getType()
        );

        foreach ($this->tripEventHandlerCollection->all() as $tripEventHandler) {
            if ($tripEventHandler->supports($tripEventDto->getType())) {
                $tripEventHandler->handle($tripEventDto);
            }
        }

        return $this->json(['status' => 'ok'], Response::HTTP_OK);
    }
}
