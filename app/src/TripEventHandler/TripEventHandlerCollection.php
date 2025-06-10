<?php

namespace App\TripEventHandler;

use Traversable;

class TripEventHandlerCollection
{
    /** @var TripEventHandlerInterface[] */
    private array $handlers;

    /**
     * @param Traversable<int, TripEventHandlerInterface> $handlers
     */
    public function __construct(Traversable $handlers)
    {
        $this->handlers = iterator_to_array($handlers);
    }

    /**
     * @return TripEventHandlerInterface[]
     */
    public function all(): array
    {
        return $this->handlers;
    }
}
