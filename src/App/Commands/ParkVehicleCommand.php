<?php

declare(strict_types=1);

namespace Fulll\App\Commands;

namespace Fulll\App\Commands;

use Fulll\Domain\Models\Vehicule;

final class ParkVehiculeCommand
{
    public function __construct(
        public Vehicule $vehicule,
        public string $gpsCoordinates
    ) {}
}
