<?php

namespace App\TripEventHandler;

use App\Dto\TripEventDto;
use App\Enum\TripEventType;

interface TripEventHandlerInterface
{
    public function supports(TripEventType $eventType): bool;

    public function handle(TripEventDto $tripEventDto): void;
}
