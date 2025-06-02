<?php

namespace App\Entity;

use App\Enum\ScooterStatus;
use App\Repository\ScooterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ScooterRepository::class)]
#[Gedmo\Timestampable]
class Scooter
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: ScooterStatus::class)]
    private ScooterStatus $status;

    #[ORM\Column(name: 'latitude', type: 'float')]
    private float $latitude;

    #[ORM\Column(name: 'longitude', type: 'float')]
    private float $longitude;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'scooters')]
    private ?User $user = null;

    /**
     * @var Collection<int, Trip>
     */
    #[ORM\OneToMany(targetEntity: Trip::class, mappedBy: 'scooterId')]
    private Collection $trips;

    public function __construct()
    {
        $this->trips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ScooterStatus
    {
        return $this->status;
    }

    public function setStatus(ScooterStatus $status): Scooter
    {
        $this->status = $status;

        return $this;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): Scooter
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): Scooter
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): Scooter
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Trip>
     */
    public function getTrips(): Collection
    {
        return $this->trips;
    }

    public function addTrip(Trip $trip): Scooter
    {
        if (!$this->trips->contains($trip)) {
            $this->trips->add($trip);
            $trip->setScooterId($this);
        }

        return $this;
    }

    public function removeTrip(Trip $trip): Scooter
    {
        if ($this->trips->removeElement($trip)) {
            if ($trip->getScooterId() === $this) {
                $trip->setScooterId(null);
            }
        }

        return $this;
    }
}
