<?php

declare(strict_types=1);

namespace Fulll\Domain\Repositories;

use Fulll\Domain\Models\Vehicle;

interface FleetVehicleRepositoryInterface
{
    public function updateFleetVehicleTable(Vehicle $vehicle, int $fleet_id): bool;
}
