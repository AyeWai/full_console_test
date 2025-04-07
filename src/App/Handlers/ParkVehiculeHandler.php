<?php

declare(strict_types=1);

namespace Fulll\App\Handlers;

use Exception;
use Fulll\Infra\Events\EventDispatcher;
use Fulll\App\Commands\RegisterVehiculeCommand;
use Fulll\Domain\Events\VehiculeRegisteredEvent;
use Fulll\Infra\Repositories\SqLiteFleetVehiculeRepository;
use Fulll\App\Commands\ParkVehiculeCommand;
use Fulll\Domain\Exception\VehicleAlreadyParkedAtThisLocationException;


final class ParkVehiculeHandler
{
    public function __construct(private SqLiteVehiculeRepository $vehiculeRepository) {}

    public function handle(ParkVehiculeCommand $command): void
    {
        $vehicule = $command->vehicule;
        $currentLocation = $this->vehiculeRepository->getLocation($vehicule);

        if ($currentLocation === $command->gpsCoordinates) {
            throw new VehicleAlreadyParkedAtThisLocationException();
        }

        $this->vehiculeRepository->updateLocation($vehicule, $command->gpsCoordinates);
    }
}
