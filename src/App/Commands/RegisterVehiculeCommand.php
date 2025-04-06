<?php

declare(strict_types=1);

namespace Fulll\App\Commands;

use Fulll\Domain\Models\Vehicule;

final class RegisterVehiculeCommand
{
    public function __construct(
        private Vehicule $vehicule,
        private int $fleet_id
    ) {}

    public function getVehicule(): Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(Vehicule $vehicule): void
    {
        $this->vehicule = $vehicule;
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
