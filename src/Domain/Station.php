<?php
declare(strict_types=1);

namespace App\Domain;

/**
 * Class Station
 * @package App\Domain
 */
class Station
{
    private int $id;
    private string $name;
    private string $lat = '0.0';
    private string $lon = '0.0';
    private bool $active = true;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     * @return $this
     */
    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return string
     */
    public function getLon(): string
    {
        return $this->lon;
    }

    /**
     * @param string $lon
     * @return $this
     */
    public function setLon(string $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return $this
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
