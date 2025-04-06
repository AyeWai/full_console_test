<?php

declare(strict_types=1);

namespace Fulll\App\Queries;

use Fulll\Domain\Models\Vehicule;
use Fulll\Infra\Repositories\SqLiteVehiculeRegistrationStatusRepository;

final class IsVehiculeRegisteredQuery
{
    public function __construct(
        private SqLiteVehiculeRegistrationStatusRepository $sqLiteVehiculeRegistrationStatusRepository
    ) {}

    public function isVehiculeRegistered(Vehicule $vehicule, int $fleet_id): bool
    {
        return $this->sqLiteVehiculeRegistrationStatusRepository->isVehiculeRegistered(vehicule: $vehicule, fleet_id: $fleet_id);
    }
}
