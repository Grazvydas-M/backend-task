<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[Gedmo\Timestampable]
class User
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Scooter>
     */
    #[ORM\OneToMany(targetEntity: Scooter::class, mappedBy: 'user')]
    private Collection $scooters;

    /**
     * @var Collection<int, Trip>
     */
    #[ORM\OneToMany(targetEntity: Trip::class, mappedBy: 'user')]
    private Collection $trips;

    public function __construct()
    {
        $this->scooters = new ArrayCollection();
        $this->trips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Scooter>
     */
    public function getScooters(): Collection
    {
        return $this->scooters;
    }

    public function addScooter(Scooter $scooter): User
    {
        if (!$this->scooters->contains($scooter)) {
            $this->scooters->add($scooter);
            $scooter->setUser($this);
        }

        return $this;
    }

    public function removeScooter(Scooter $scooter): User
    {
        if ($this->scooters->removeElement($scooter)) {
            if ($scooter->getUser() === $this) {
                $scooter->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Trip>
     */
    public function getTrips(): Collection
    {
        return $this->trips;
    }

    public function addTrip(Trip $trip): User
    {
        if (!$this->trips->contains($trip)) {
            $this->trips->add($trip);
            $trip->setUser($this);
        }

        return $this;
    }
}
