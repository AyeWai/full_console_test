<?php

declare(strict_types=1);

namespace Fulll\Infra\Repositories;

use Fulll\Domain\Models\Vehicule;
use Fulll\Domain\Repositories\FleetVehiculeRepositoryInterface;

class SqLiteFleetVehiculeRepository implements FleetVehiculeRepositoryInterface
{
    public function updateFleetVehiculeTable(Vehicule $vehicule, int $fleet_id): bool
    {
        try {
            $db = new \SQLite3('src/Infra/my_database.db');
            $pre_result = $db->prepare(
                'INSERT INTO fleets_vehicules (fleet_id, vehicule_id)
                VALUES (?, ?)'
            );
            $pre_result->bindValue(1, $fleet_id, SQLITE3_INTEGER);
            $pre_result->bindValue(2, $vehicule->getId(), SQLITE3_INTEGER);
            $pre_result->execute();
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        $db->close();
        return true;
    }
}
