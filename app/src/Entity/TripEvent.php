<?php

namespace App\Entity;

use App\Enum\TripEventType;
use App\Repository\TripEventRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripEventRepository::class)]
class TripEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'latitude', type: 'float')]
    private float $latitude;

    #[ORM\Column(name: 'longitude', type: 'float')]
    private float $longitude;

    #[ORM\Column(enumType: TripEventType::class)]
    private TripEventType $eventType;

    #[ORM\Column(name: 'time', type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $time;

    #[ORM\ManyToOne(targetEntity: Trip::class)]
    private Trip $trip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): TripEvent
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): TripEvent
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getTime(): DateTimeImmutable
    {
        return $this->time;
    }

    public function setTime(DateTimeImmutable $time): TripEvent
    {
        $this->time = $time;

        return $this;
    }

    public function getTrip(): Trip
    {
        return $this->trip;
    }

    public function setTrip(Trip $trip): TripEvent
    {
        $this->trip = $trip;

        return $this;
    }

    public function getEventType(): TripEventType
    {
        return $this->eventType;
    }

    public function setEventType(TripEventType $eventType): TripEvent
    {
        $this->eventType = $eventType;

        return $this;
    }
}
