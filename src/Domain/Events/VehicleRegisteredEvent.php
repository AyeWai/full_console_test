<?php

declare(strict_types=1);

namespace Fulll\Domain\Events;

use Fulll\Domain\Models\Vehicle;

final class VehicleRegisteredEvent
{
    public function __construct(
        private Vehicle $vehicle,
        private int $fleet_id,
    ) {
    }

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function getFleetId(): int
    {
        return $this->fleet_id;
    }
}
