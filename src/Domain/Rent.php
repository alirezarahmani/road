<?php
declare(strict_types=1);

namespace App\Domain;

/**
 * Class Rent
 * @package App\Domain
 */
class Rent
{
    private \DateTimeInterface $startAt;
    private \DateTimeInterface $endAt;
    private int $id;
    private Station $endStation;
    private Station $startStation;
    private Van $van;

    public function __construct()
    {
    }

    /**
     * @return \DateTimeInterface
     */
    public function getStartAt(): \DateTimeInterface
    {
        return $this->startAt;
    }

    /**
     * @param \DateTimeInterface $startAt
     * @return $this
     */
    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getEndAt(): \DateTimeInterface
    {
        return $this->endAt;
    }

    /**
     * @param \DateTimeInterface $endAt
     * @return $this
     */
    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

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
    public function getEndStation(): Station
    {
        return $this->endStation;
    }

    /**
     * @param Station $endStation
     * @return $this
     */
    public function setEndStation(Station $endStation): self
    {
        $this->endStation = $endStation;

        return $this;
    }

    /**
     * @return Station
     */
    public function getStartStation(): Station
    {
        return $this->startStation;
    }

    /**
     * @param Station $startStation
     * @return $this
     */
    public function setStartStation(Station $startStation): self
    {
        $this->startStation = $startStation;

        return $this;
    }

    /**
     * @return Van
     */
    public function getVan(): Van
    {
        return $this->van;
    }

    /**
     * @param Van $van
     * @return $this
     */
    public function setVan(Van $van): self
    {
        $this->van = $van;

        return $this;
    }
}
