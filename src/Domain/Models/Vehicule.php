<?php

declare(strict_types=1);

namespace Fulll\Domain\Models;

final class Vehicle
{
    public function __construct(
        private string $plate_number
    ) {}

    public function getPlateNumber(): ?string
    {
        return $this->plate_number;
    }

    public function setPlateNumber(?string $plate_number): void
    {
        $this->plate_number = $plate_number;
    }
}
