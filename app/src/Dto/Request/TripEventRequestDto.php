<?php

namespace App\Dto\Request;

use App\Entity\Scooter;
use App\Entity\User;
use App\Enum\TripEventType;
use Symfony\Component\Validator\Constraints as Assert;

readonly class TripEventRequestDto
{
    public function __construct(
        #[Assert\NotNull]
        private User $user,
        #[Assert\NotNull]
        private Scooter $scooter,
        #[Assert\NotNull]
        private TripEventType $type
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getType(): TripEventType
    {
        return $this->type;
    }

    public function getScooter(): Scooter
    {
        return $this->scooter;
    }
}
