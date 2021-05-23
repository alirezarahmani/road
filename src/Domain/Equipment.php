<?php
declare(strict_types=1);

namespace App\Domain;

/**
 * Class Equipment
 * @package App\Domain
 */
class Equipment
{
    private int $id;
    private string $name;
    private bool $status = true;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
