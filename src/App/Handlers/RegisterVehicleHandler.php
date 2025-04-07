<?php

declare(strict_types=1);

namespace Fulll\App\Handlers;

use Fulll\App\Commands\RegisterVehicleCommand;
use Fulll\Domain\Events\VehicleRegisteredEvent;
use Fulll\Infra\Events\EventDispatcher;
use Fulll\Infra\Repositories\SqLiteFleetVehicleRepository;

final class RegisterVehicleHandler
{
    public function __construct(
        private SqLiteFleetVehicleRepository $sqLiteFleetVehicleRepository,
        private EventDispatcher $eventDispatcher,
    ) {
    }

    public function handle(RegisterVehicleCommand $command): void
    {
        $vehicle = $command->getVehicle();
        $fleet_id = $command->getFleetId();

        try {
            $this->sqLiteFleetVehicleRepository->updateFleetVehicleTable(vehicle : $vehicle, fleet_id : $fleet_id);
            $event = new VehicleRegisteredEvent(vehicle : $vehicle, fleet_id : $fleet_id);
            $this->eventDispatcher->dispatch($event);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong in the vehicle registration process');
        }
    }
}
