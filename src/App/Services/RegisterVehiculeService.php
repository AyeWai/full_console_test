<?php

declare(strict_types=1);

namespace Fulll\App\Services;

use Fulll\Domain\Models\Vehicule;
use Fulll\App\Commands\RegisterVehiculeCommand;
use Fulll\App\Handlers\RegisterVehiculeHandler;
use Fulll\App\Queries\IsVehiculeRegisteredQuery;
use Fulll\Domain\Exceptions\VehiculeAlreadyRegisteredException;

final class RegisterVehiculeService
{
    public function __construct(
        private RegisterVehiculeHandler $registerVehiculeHandler,
        private IsVehiculeRegisteredQuery $isVehiculeRegisteredQuery,
    ) {}

    public function registerVehicule(Vehicule $vehicule, int $fleet_id): void
    {
        if ($this->isVehiculeRegisteredQuery->isVehiculeRegistered(vehicule: $vehicule, fleet_id: $fleet_id)) {
            throw new VehiculeAlreadyRegisteredException();
        }
        $this->registerVehiculeHandler->handle(new RegisterVehiculeCommand(vehicule: $vehicule, fleet_id: $fleet_id));
    }
}
