<?php

declare(strict_types=1);

namespace Fulll\Domain\Models;

final class Vehicule
{
    public function __construct(
        private int $id,
        private ?string $location_id = null
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLocation(): ?string
    {
        return $this->location_id;
    }

    public function setLocation(?string $location): void
    {
        $this->location_id = $location;
    }
}
