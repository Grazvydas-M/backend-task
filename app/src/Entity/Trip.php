<?php

namespace App\Entity;

use App\Enum\TripStatus;
use App\Repository\TripRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: TripRepository::class)]
#[Gedmo\Timestampable]
class Trip
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?DateTimeImmutable $duration = null;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(name: 'scooter_id', referencedColumnName: 'id', nullable: false)]
    private Scooter $scooter;

    #[ORM\ManyToOne(inversedBy: 'trips')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private User $user;

    #[ORM\Column(enumType: TripStatus::class)]
    private TripStatus $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): DateTimeImmutable
    {
        return $this->duration;
    }

    public function setDuration(DateTimeImmutable $duration): Trip
    {
        $this->duration = $duration;

        return $this;
    }

    public function getScooter(): Scooter
    {
        return $this->scooter;
    }

    public function setScooter(Scooter $scooter): Trip
    {
        $this->scooter = $scooter;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $userId): Trip
    {
        $this->user = $userId;

        return $this;
    }

    public function getStatus(): TripStatus
    {
        return $this->status;
    }

    public function setStatus(TripStatus $status): Trip
    {
        $this->status = $status;

        return $this;
    }
}
