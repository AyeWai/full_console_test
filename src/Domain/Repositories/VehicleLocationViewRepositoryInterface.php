<?php

declare(strict_types=1);

namespace Fulll\Domain\Repositories;

use Fulll\Domain\Models\Vehicle;

interface VehicleLocationRepositoryInterface
{
    public function isSameLocation(Vehicle $vehicle, string $gps_coordinates, null|string $alt): bool;
}
