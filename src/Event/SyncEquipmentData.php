<?php
declare(strict_types = 1);

namespace App\Event;

use App\Domain\RentStationEquipment;
use App\Domain\StationEquipments;
use App\Lib\EquipmentStock;
use App\Repositories\StationEquipmentRepository;
use App\Storage\StorageInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

/**
 * Class SyncEquipmentData
 * @package App\Event
 */
class SyncEquipmentData implements EventSubscriber
{
    public function __construct(private StorageInterface $cache, private StationEquipmentRepository $repository)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        //@todo same as post persist
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!is_a($entity, RentStationEquipment::class)) {
            return;
        }
        /** @var RentStationEquipment $entity */
        $rent = $entity->getRent();
        $stationEquipment = $entity->getStationEquipment();
        $equipment = $stationEquipment->getEquipment();
        $stock = new EquipmentStock(
            $this->cache,
            $equipment,
            $entity->getCount()
        );
        $stock->decrease($rent->getStartStation(), $rent->getStartAt(), $stationEquipment->getStock());
        $stock->increase(
            $rent->getEndStation(),
            $rent->getEndAt(),
            $entity->getStationEquipmentDestination()->getStock()
        );
        $this->updateStationStock($stationEquipment, $entity->getCount());
    }

    private function updateStationStock(StationEquipments $station, int $count): void
    {
        $station->setStock($station->getStock() - $count);
        $this->repository->updateCapacity($station);
    }
}
