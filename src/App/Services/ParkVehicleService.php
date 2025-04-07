<?php

declare(strict_types=1);

namespace Fulll\App\Services;

use Fulll\App\Commands\ParkVehicleCommand;
use Fulll\App\Handlers\ParkVehicleHandler;
use Fulll\App\Queries\IsSameLocationQuery;
use Fulll\App\Queries\IsVehicleRegisteredQuery;
use Fulll\Domain\Exception\VehicleAlreadyParkedAtThisLocationException;
use Fulll\Domain\Models\Vehicle;

final class ParkVehicleService
{
    public function __construct(
        private ParkVehicleHandler $parkVehicleHandler,
        private IsSameLocationQuery $isSameLocationQuery,
        private IsVehicleRegisteredQuery $isVehicleRegisteredQuery,
    ) {
    }

    public function parkVehicle(Vehicle $vehicle, int $fleet_id, int $location_id, string $gps_coordinates, ?string $alt): void
    {
        if ($this->isSameLocationQuery->isSameLocation(vehicle : $vehicle, gps_coordinates : $gps_coordinates, alt: $alt)) {
            throw new VehicleAlreadyParkedAtThisLocationException();
        }
        $this->parkVehicleHandler->handle(new ParkVehicleCommand(vehicle : $vehicle, fleet_id : $fleet_id, location_id: $location_id, gpsCoordinates : $gps_coordinates, alt : $alt));
    }
}
