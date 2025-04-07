<?php

declare(strict_types=1);

namespace Fulll\App\Commands;

namespace Fulll\App\Commands;

use Fulll\Domain\Models\Vehicle;

final class ParkVehicleCommand
{
    public function __construct(
        public Vehicle $vehicle,
        public string $gpsCoordinates
    ) {}
}
