<?php
declare(strict_types=1);

namespace App\Domain;

/**
 * Class StationEquipments
 * @package App\Domain
 */
class StationEquipments
{
    private int $id;
    private int $stock;
    private Station $station;
    private Equipment $equipment;

    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return $this
     */
    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Station
     */
    public function getStation(): Station
    {
        return $this->station;
    }

    /**
     * @param Station $station
     * @return $this
     */
    public function setStation(Station $station): self
    {
        $this->station = $station;
        return $this;
    }

    /**
     * @return Equipment
     */
    public function getEquipment(): Equipment
    {
        return $this->equipment;
    }

    /**
     * @param Equipment $equipment
     * @return $this
     */
    public function setEquipment(Equipment $equipment): self
    {
        $this->equipment = $equipment;
        return $this;
    }
}
