<?php
declare(strict_types = 1);

namespace App\Service;

use App\Domain\Rent;
use App\Repositories\RentRepository;
use Symfony\Component\Serializer\Serializer;

/**
 * Class AsyncDenomalize
 * @package App\Service
 */
class Denormalizer
{

    public function __construct(private RentRepository $repository)
    {}

    public function syncRent(Serializer $serializer, string $input)
    {
        $data = $serializer->deserialize($input, Rent::class, 'xml');
        $this->repository->updateCacheTable($data);
    }
}
