<?php

namespace App\Dto;

use App\Entity\Scooter;
use App\Entity\User;
use App\Enum\TripEventType;

readonly class TripDto
{
    public function __construct(
        private User $user,
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
