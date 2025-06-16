<?php

namespace App\Controller;

use App\Dto\Request\TripCreateRequestDto;
use App\Dto\Request\TripUpdateRequestDto;
use App\Dto\TripDto;
use App\Entity\Trip;
use App\Entity\TripEvent;
use App\Factory\TripFactory;
use App\Handler\TripUpdateHandler;
use App\Resolver\TripRequestDtoResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class TripsController extends AbstractController
{
    public function __construct(
        private readonly TripFactory $tripFactory,
        private readonly TripUpdateHandler $tripUpdateHandler,
    ) {
    }

    #[Route('/trips', name: 'trips_index', methods: ['GET'])]
    public function index(): Response
    {
//        list of trips
        return new Response('Event endpoint is working!');
    }

    #[Route('/trips', name: 'trips_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload(
            resolver: TripRequestDtoResolver::class
        )] TripCreateRequestDto $tripRequestDto
    ): Response {
        $tripDto = $this->tripFactory->createRequestDto($tripRequestDto);
        $trip = $this->tripFactory->createFromDto($tripDto);
        $tripResponseDto = $this->tripFactory->createResponseDto($trip);

        return $this->json($tripResponseDto, Response::HTTP_CREATED);
    }

    #[Route('/trips/{id}', name: 'trip_update', methods: ['PATCH'])]
    public function update(
        Trip $trip,
        #[MapRequestPayload] TripUpdateRequestDto $tripUpdateRequestDto
    ): Response {
        $this->tripUpdateHandler->handle($trip, $tripUpdateRequestDto);

        return $this->json([], Response::HTTP_OK);
    }
}
