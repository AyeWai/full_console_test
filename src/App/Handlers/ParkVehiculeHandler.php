<?php

declare(strict_types=1);

namespace Fulll\App\Handlers;

use Exception;
use Fulll\Infra\Events\EventDispatcher;
use Fulll\App\Commands\RegisterVehicleCommand;
use Fulll\Domain\Events\VehicleRegisteredEvent;
use Fulll\Infra\Repositories\SqLiteFleetVehicleRepository;
use Fulll\App\Commands\ParkVehicleCommand;
use Fulll\Domain\Exception\VehicleAlreadyParkedAtThisLocationException;


final class ParkVehicleHandler
{
    public function __construct(private SqLiteVehicleRepository $vehicleRepository) {}

    public function handle(ParkVehicleCommand $command): void
    {
        $vehicle = $command->vehicle;
        $currentLocation = $this->vehicleRepository->getLocation($vehicle);

        if ($currentLocation === $command->gpsCoordinates) {
            throw new VehicleAlreadyParkedAtThisLocationException();
        }

        $this->vehicleRepository->updateLocation($vehicle, $command->gpsCoordinates);
    }
}
