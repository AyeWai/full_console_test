<?php

declare(strict_types=1);

namespace Fulll\App\Queries;

use Fulll\Domain\Models\Vehicle;
use Fulll\Infra\Repositories\SqLiteVehicleRegistrationStatusRepository;

final class IsVehicleRegisteredQuery
{
    public function __construct(
        private SqLiteVehicleRegistrationStatusRepository $sqLiteVehicleRegistrationStatusRepository,
    ) {
    }

    public function isVehicleRegistered(Vehicle $vehicle, int $fleet_id): bool
    {
        return $this->sqLiteVehicleRegistrationStatusRepository->isVehicleRegistered(vehicle: $vehicle, fleet_id: $fleet_id);
    }
}
