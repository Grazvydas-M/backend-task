<?php

namespace App\Resolver;

use App\Dto\Request\TripCreateRequestDto;
use App\Enum\TripEventType;
use App\Repository\ScooterRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class TripRequestDtoResolver implements ValueResolverInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private ScooterRepository $scooterRepository,
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === TripCreateRequestDto::class;
    }

    /**
     * @return TripCreateRequestDto[]
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data) || !isset($data['userId'], $data['scooterId'])) {
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

        yield new TripCreateRequestDto($user, $scooter);
    }
}
