<?php

namespace App\Resolver;

use App\Dto\Request\TripCreateRequestDto;
use App\Dto\Request\TripEventCreateRequestDto;
use App\Enum\TripEventType;
use App\Repository\TripRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class TripEventRequestDtoResolver implements ValueResolverInterface
{
    public function __construct(
        private TripRepository $tripRepository,
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === TripEventCreateRequestDto::class;
    }

    /**
     * @return TripCreateRequestDto[]
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $tripId = $request->attributes->get('id');
        $data = json_decode($request->getContent(), true);

        if (!is_array($data) || !isset($tripId, $data['latitude'], $data['longitude'], $data['eventType'])) {
            throw new BadRequestHttpException('Invalid or missing request data');
        }

        $trip = $this->tripRepository->find($tripId);
        if (!$trip) {
            throw new BadRequestHttpException('Trip not found');
        }

        $latitude = filter_var($data['latitude'], FILTER_VALIDATE_FLOAT);
        $longitude = filter_var($data['longitude'], FILTER_VALIDATE_FLOAT);

        if (!$latitude || !$longitude) {
            throw new BadRequestHttpException('Invalid coordinates');
        }

        $eventType = TripEventType::tryFrom($data['eventType']);

        if (!$eventType) {
            throw new BadRequestHttpException('Invalid event type');
        }

        yield new TripEventCreateRequestDto($trip, $latitude, $longitude, $eventType);
    }
}
