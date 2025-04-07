<?php

declare(strict_types=1);

namespace Fulll\Infra\Repositories;

use Fulll\Domain\Models\Vehicle;

final class SqLiteVehicleLocationRepository
{
    public function updateVehiculeLocationTable(Vehicle $vehicle, int $location_id): bool
    {
        try {
            $db = new \SQLite3($_ENV['DB_PATH']);

            $pre_result = $db->prepare(
                'INSERT INTO vehicles_locations (vehicle_id, location_id)
                VALUES (?, ?)'
            );

            $pre_result->bindValue(1, $vehicle->getId(), SQLITE3_INTEGER);
            $pre_result->bindValue(1, $location_id, SQLITE3_INTEGER);
            $pre_result->execute();
        } catch (\Exception $e) {
            echo 'Error: '.$e->getMessage();

            return false;
        }

        $db->close();

        return true;
    }
}
