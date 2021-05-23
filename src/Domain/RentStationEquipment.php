<?php
declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class RentStationEquipment
 * @package App\Domain
 */
class RentStationEquipment
{
    private int $id;
    private Rent $rent;
    private StationEquipments $stationEquipment;
    private StationEquipments $stationEquipmentDestination;
    private int $count;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRent(): Rent
    {
        return $this->rent;
    }

    public function setRent(Rent $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * @return StationEquipments
     */
    public function getStationEquipmentDestination(): StationEquipments
    {
        return $this->stationEquipmentDestination;
    }

    /**
     * @param StationEquipments $stationEquipmentDestination
     */
    public function setStationEquipmentDestination(StationEquipments $stationEquipmentDestination): void
    {
        $this->stationEquipmentDestination = $stationEquipmentDestination;
    }

    public function getStationEquipment(): StationEquipments
    {
        return $this->stationEquipment;
    }

    public function setStationEquipment(StationEquipments $stationEquipment): self
    {
        $this->stationEquipment = $stationEquipment;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function checkCount(LifecycleEventArgs $event): void
    {
        /** @var RentStationEquipment $entity */
        $entity = $event->getEntity();

        if ($this->count > $entity->getStationEquipment()->getStock()) {
            throw new \InvalidArgumentException();
        }
    }
}
