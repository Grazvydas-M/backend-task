<?php

namespace App\Dto\Request;

use App\Entity\Scooter;
use App\Entity\User;
use App\Enum\TripEventType;
use Symfony\Component\Validator\Constraints as Assert;

readonly class TripCreateRequestDto
{
    public function __construct(
        #[Assert\NotNull]
        private User $user,
        #[Assert\NotNull]
        private Scooter $scooter,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getScooter(): Scooter
    {
        return $this->scooter;
    }
}
