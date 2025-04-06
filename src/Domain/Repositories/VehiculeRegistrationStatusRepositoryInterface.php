<?php

declare(strict_types=1);

namespace Fulll\Domain\Repositories;

use Fulll\Domain\Models\Vehicule;

interface VehiculeRegistrationStatusRepositoryInterface
{
    public function isVehiculeRegistered(Vehicule $vehicule, int $fleet_id): bool;
}
