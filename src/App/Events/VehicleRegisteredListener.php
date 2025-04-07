<?php

declare(strict_types=1);

namespace Fulll\App\Events;

use Fulll\Domain\Events\VehicleRegisteredEvent;
use Fulll\Infra\Repositories\SqLiteFleetVehicleRepository;

final class VehicleRegisteredListener
{
    public function __construct(
        private sqLiteFleetVehicleRepository $sqLiteFleetVehicleRepository
    ) {}

    public function __invoke(VehicleRegisteredEvent $event): void
    {
        $this->sqLiteFleetVehicleRepository->updateFleetVehicleTable(vehicle: $event->getVehicle(), fleet_id: $event->getFleetId());
    }
}
