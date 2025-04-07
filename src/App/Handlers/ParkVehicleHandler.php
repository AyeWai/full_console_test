<?php

declare(strict_types=1);

namespace Fulll\App\Handlers;

use Fulll\App\Commands\ParkVehicleCommand;
use Fulll\Infra\Repositories\SqLiteVehicleLocationRepository;

final class ParkVehicleHandler
{
    public function __construct(
        private SqLiteVehicleLocationRepository $sqLiteVehicleLocationRepository,
    ) {
    }

    public function handle(ParkVehicleCommand $command): void
    {
        $vehicle = $command->getVehicle();
        $fleet_id = $command->getFleetId();

        $this->sqLiteVehicleLocationRepository->updateVehiculeLocationTable(vehicle : $vehicle, fleet_id : $fleet_id);
    }
}
