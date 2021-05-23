<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Rent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Class RentRepository
 * @package App\Repositories
 */
class RentRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Rent::class));
    }
}
