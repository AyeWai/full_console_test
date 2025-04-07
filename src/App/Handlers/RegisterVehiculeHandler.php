<?php

declare(strict_types=1);

namespace Fulll\App\Handlers;

use Exception;
use Fulll\Infra\Events\EventDispatcher;
use Fulll\App\Commands\RegisterVehiculeCommand;
use Fulll\Domain\Events\VehiculeRegisteredEvent;
use Fulll\Infra\Repositories\SqLiteFleetVehiculeRepository;

final class RegisterVehiculeHandler
{
    public function __construct(
        private SqLiteFleetVehiculeRepository $sqLiteFleetVehiculeRepository,
        private EventDispatcher $eventDispatcher
    ) {}

    public function handle(RegisterVehiculeCommand $command): void
    {
        $vehicule = $command->getVehicule();
        $fleet_id = $command->getFleetId();

        try {
            $this->sqLiteFleetVehiculeRepository->updateFleetVehiculeTable(vehicule : $vehicule, fleet_id : $fleet_id);
            $event = new VehiculeRegisteredEvent(vehicule : $vehicule, fleet_id : $fleet_id);
            $this->eventDispatcher->dispatch($event);
        } catch (Exception $e) {
            throw new \Exception("Something went wrong in the vehicule registration process");
        }
    }
}
