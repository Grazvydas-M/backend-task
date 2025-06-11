<?php

namespace App\Dto\Response;

readonly class TripCreateResponseDto
{
    public function __construct(
       private int $tripId,
    ) {
    }

    public function getTripId(): int
    {
        return $this->tripId;
    }
}