<?php

namespace App\Domain;

class RentStationEquipment
{
    private int $id;
    private Rent $rent;
    private StationEquipments $stationEquipment;
    private int $count;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRent(): ?Rent
    {
        return $this->rent;
    }

    public function setRent(Rent $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    public function getStationEquipment(): ?StationEquipments
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

    public function checkCount($event)
    {
        /** @var RentStationEquipment $entity */
        $entity = $event->getEntity();

        if ($this->count > $entity->getStationEquipment()->getStock()) {
            throw new \InvalidArgumentException();
        }
    }
}
