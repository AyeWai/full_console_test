<?php

declare(strict_types=1);

namespace Fulll\App\Queries;

use Fulll\Domain\Models\Vehicle;
use Fulll\Infra\Repositories\SqLiteVehicleLocationViewRepository;

final class IsSameLocationQuery
{
    public function __construct(
        private SqLiteVehicleLocationViewRepository $sqLiteVehicleLocationViewRepository,
    ) {
    }

    public function isSameLocation(Vehicle $vehicle, string $gps_coordinates, ?string $alt): bool
    {
        return $this->sqLiteVehicleLocationViewRepository->isSameLocation(vehicle : $vehicle, gps_coordinates : $gps_coordinates, alt : $alt);
    }
}
