<?php

declare(strict_types=1);

namespace Fulll\Infra\Repositories;

use Fulll\Domain\Models\Vehicle;
use Fulll\Domain\Repositories\VehicleRegistrationStatusRepositoryInterface;

final class SqLiteVehicleRegistrationStatusRepository implements VehicleRegistrationStatusRepositoryInterface
{
    public function isVehicleRegistered(Vehicle $vehicle, int $fleet_id): bool
    {
        try {

            $db = new \SQLite3($_ENV['DB_PATH']);

            $pre_result = $db->prepare('SELECT * FROM vehicle_registration_status WHERE plate_number = ? AND associated_fleet = ? AND registration_status = "REGISTERED"');
            $pre_result->bindValue(1, $vehicle->getPlateNumber(), SQLITE3_TEXT);
            $pre_result->bindValue(2, $fleet_id, SQLITE3_INTEGER);

            $result = $pre_result->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            $result->finalize();

            if ($row === false) {
                return false;
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        $db->close();
        return true;
    }
}
