<?php

declare(strict_types=1);

namespace Fulll\App\Services;

use Fulll\App\Commands\RegisterVehicleCommand;
use Fulll\App\Handlers\RegisterVehicleHandler;
use Fulll\App\Queries\IsVehicleRegisteredQuery;
use Fulll\Domain\Exceptions\VehicleAlreadyRegisteredException;
use Fulll\Domain\Models\Vehicle;

final class RegisterVehicleService
{
    public function __construct(
        private RegisterVehicleHandler $registerVehicleHandler,
        private IsVehicleRegisteredQuery $isVehicleRegisteredQuery,
    ) {
    }

    public function registerVehicle(Vehicle $vehicle, int $fleet_id): void
    {
        if ($this->isVehicleRegisteredQuery->isVehicleRegistered(vehicle: $vehicle, fleet_id: $fleet_id)) {
            throw new VehicleAlreadyRegisteredException();
        }
        $this->registerVehicleHandler->handle(new RegisterVehicleCommand(vehicle: $vehicle, fleet_id: $fleet_id));
    }
}
