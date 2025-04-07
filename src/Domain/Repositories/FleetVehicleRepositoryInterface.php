<?php

declare(strict_types=1);

namespace Fulll\Domain\Repositories;

use Fulll\Domain\Models\Vehicule;

interface FleetVehiculeRepositoryInterface
{
    public function updateFleetVehiculeTable(Vehicule $vehicule, int $fleet_id): bool;
}
