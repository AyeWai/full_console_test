<?php

declare(strict_types=1);

namespace Fulll\Infra\Repositories;

use Fulll\Domain\Models\Vehicle;
use Fulll\Domain\Repositories\FleetVehicleRepositoryInterface;

final class SqLiteFleetVehicleRepository implements FleetVehicleRepositoryInterface
{
    public function updateFleetVehicleTable(Vehicle $vehicle, int $fleet_id): bool
    {
        try {
            $db = new \SQLite3($_ENV['DB_PATH']);

            $pre_result = $db->prepare(
                'INSERT INTO fleets_vehicles (fleet_id, vehicle_id)
                VALUES (?, ?)'
            );

            $pre_result->bindValue(1, $fleet_id, SQLITE3_INTEGER);
            $pre_result->bindValue(2, $vehicle->getId(), SQLITE3_INTEGER);
            $pre_result->execute();
            
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        $db->close();
        return true;
    }
}
