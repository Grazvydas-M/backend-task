<?php

namespace App\Entity;

use App\Repository\TripEventRepository;
use DateTime;
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

    #[ORM\Column(name: 'time', type: Types::TIME_MUTABLE)]
    private DateTime $time;

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

    public function getTime(): DateTime
    {
        return $this->time;
    }

    public function setTime(DateTime $time): TripEvent
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
}
