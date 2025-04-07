<?php

declare(strict_types=1);

namespace Fulll\App\Commands;

use Fulll\Domain\Models\Vehicle;

final class RegisterVehicleCommand
{
    public function __construct(
        private Vehicle $vehicle,
        private int $fleet_id
    ) {}

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    public function getFleetId(): int
    {
        return $this->fleet_id;
    }

    public function setFleetId(int $fleet_id): void
    {
        $this->fleet_id = $fleet_id;
    }
}
