<?php

namespace App\Resolver;

use App\Dto\Request\TripEventRequestDto;
use App\Enum\TripEventType;
use App\Repository\ScooterRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class TripEventRequestDtoResolver implements ValueResolverInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private ScooterRepository $scooterRepository,
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === TripEventRequestDto::class;
    }

    /**
     * @return TripEventRequestDto[]
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data) || !isset($data['userId'], $data['scooterId'], $data['type'])) {
            throw new BadRequestHttpException('Invalid or missing request data');
        }

        $user = $this->userRepository->find($data['userId']);
        if (!$user) {
            throw new BadRequestHttpException('User not found');
        }

        $scooter = $this->scooterRepository->find($data['scooterId']);
        if (!$scooter) {
            throw new BadRequestHttpException('Scooter not found');
        }

        if (!is_string($data['type'])) {
            throw new BadRequestHttpException('Invalid type');
        }

        $type = TripEventType::tryFrom($data['type']);
        if (!$type) {
            throw new BadRequestHttpException('Invalid TripEventType');
        }

        yield new TripEventRequestDto($user, $scooter, $type);
    }
}
