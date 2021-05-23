<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Domain\StationEquipments;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

/**
 * Class StationEquipmentRepository
 * @package App\Repositories
 */
class StationEquipmentRepository extends EntityRepository
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(StationEquipments::class));
    }

    /**
     * @param StationEquipments $station
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateCapacity(StationEquipments $station): void
    {
        $this->_em->persist($station);
        $this->_em->flush();
    }
}
