<?php

declare(strict_types=1);

namespace Fulll\Infra\Repositories;

use Fulll\Domain\Models\Vehicle;
use Fulll\Domain\Repositories\VehicleLocationRepositoryInterface;

final class SqLiteVehicleLocationViewRepository implements VehicleLocationRepositoryInterface
{
    public function isSameLocation(Vehicle $vehicle, string $gps_coordinates, ?string $alt): bool
    {
        try {
            $db = new \SQLite3($_ENV['DB_PATH']);

            $pre_result = $db->prepare(
                'SELECT * FROM vehicle_location_view
                WHERE plate_numer = ?
                AND gps_coordinates = ?
                AND alt = ?'
            );

            $pre_result->bindValue(1, $vehicle->getPlateNumber(), SQLITE3_TEXT);
            $pre_result->bindValue(2, $gps_coordinates, SQLITE3_TEXT);
            $pre_result->bindValue(3, $alt, SQLITE3_TEXT);
            $pre_result->execute();

            $result = $pre_result->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            $result->finalize();

            if (false === $row) {
                return false;
            }
        } catch (\Exception $e) {
            echo 'Error: '.$e->getMessage();

            return false;
        }

        $db->close();

        return true;
    }
}
