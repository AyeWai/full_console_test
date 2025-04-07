<?php

declare(strict_types=1);

namespace Fulll\App\Services;

use Fulll\Domain\Models\Vehicle;
use Fulll\App\Handlers\ParkVehicleHandler;
use Fulll\App\Queries\IsSameLocationQuery;
use Fulll\App\Commands\RegisterVehicleCommand;
use Fulll\App\Queries\IsVehicleRegisteredQuery;
use Fulll\Domain\Exceptions\VehicleAlreadyRegisteredException;

final class ParkVehicleService
{
    public function __construct(
        private ParkVehicleHandler $parkVehicleHandler,
        private IsSameLocationQuery $isSameLocationQuery,
        private IsVehicleRegisteredQuery $isVehicleRegisteredQuery,
    ) {}

    public function parkVehicle(Vehicle $vehicle, int $fleet_id, string $gps_coordinates, null|string $alt): void
    {
        if ($this->isSameLocationQuery->isSameLocation(vehicle : $vehicle, gps_coordinates : $gps_coordinates, alt: $alt)) {
            throw new VehicleAlreadyRegisteredException();
        }
        $this->parkVehicleHandler->handle(new ParkVehicleCommand(vehicle: $vehicle, fleet_id: $fleet_id));
    }
}
