<?php

declare(strict_types=1);

namespace Fulll\App\Commands;

final class VehiculeRegisteredCommand
{
    public function __construct(
        private int $vehicule_id
    ) {}

    public function getVehiculeId(): int
    {
        return $this->vehicule_id;
    }
}
