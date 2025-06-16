<?php

namespace App\Dto\Request;

use App\Enum\TripStatus;

readonly class TripUpdateRequestDto
{
    public function __construct(
        private TripStatus $status,
    ) {
    }

    public function getStatus(): TripStatus
    {
        return $this->status;
    }
}