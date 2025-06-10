<?php

namespace App\Repository;

use App\Entity\TripEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TripEvent>
 */
class TripEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TripEvent::class);
    }

    public function save(TripEvent $tripEvent, bool $flush = false): void
    {
        $this->getEntityManager()->persist($tripEvent);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
