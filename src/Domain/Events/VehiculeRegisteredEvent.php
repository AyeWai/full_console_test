<?php

declare(strict_types=1);

namespace Fulll\Domain\Events;

use Fulll\Domain\Models\Vehicule;

final class VehiculeRegisteredEvent
{
    public function __construct(
        private Vehicule $vehicule,
        private int $fleet_id
    ) {}

    public function getVehicule(): Vehicule
    {
        return $this->vehicule;
    }

    public function getFleetId(): int
    {
        return $this->fleet_id;
    }
}
