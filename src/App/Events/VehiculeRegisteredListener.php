<?php

declare(strict_types=1);

namespace Fulll\App\Events;

use Fulll\Domain\Events\VehiculeRegisteredEvent;
use Fulll\Infra\Repositories\SqLiteFleetVehiculeRepository;

class VehiculeRegisteredListener
{
    public function __construct(
        private sqLiteFleetVehiculeRepository $sqLiteFleetVehiculeRepository
    ) {}

    public function __invoke(VehiculeRegisteredEvent $event): void
    {
        $this->sqLiteFleetVehiculeRepository->updateFleetVehiculeTable(vehicule: $event->getVehicule(), fleet_id: $event->getFleetId());
    }
}
