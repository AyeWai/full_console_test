<?php

declare(strict_types=1);

namespace Fulll\Domain\Repositories;

use Fulll\Domain\Models\Vehicle;

interface VehicleRegistrationStatusRepositoryInterface
{
    public function isVehicleRegistered(Vehicle $vehicle, int $fleet_id): bool;
}
