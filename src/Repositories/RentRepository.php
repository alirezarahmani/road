<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Rent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\ClassMetadata;

class RentRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Rent::class));
    }

    public function findAllRentsAndEquipments()
    {
    }

    public function creat($a)
    {
        $this->_em->persist($a);
        $this->_em->flush();
    }

    public function em()
    {
        return $this->_em;
    }

    public function updateCacheTable( $data)
    {
        $sql = "SELECT DATE_FORMAT(whatever.createdAt, '%Y-%m-%d') FORM whatever...";
        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->exec($sql);
    }
}
