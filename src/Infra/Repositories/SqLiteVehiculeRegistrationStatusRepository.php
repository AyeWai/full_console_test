<?php

declare(strict_types=1);

namespace Fulll\Infra\Repositories;

use Fulll\Domain\Models\Vehicule;
use Fulll\Domain\Repositories\VehiculeRegistrationStatusRepositoryInterface;

final class SqLiteVehiculeRegistrationStatusRepository implements VehiculeRegistrationStatusRepositoryInterface
{
    public function isVehiculeRegistered(Vehicule $vehicule, int $fleet_id): bool
    {
        try {

            $db = new \SQLite3($_ENV['DB_PATH']);

            $pre_result = $db->prepare('SELECT * FROM vehicule_registration_status WHERE vehicule_id = ? AND associated_fleet = ? AND registration_status = "REGISTERED"');
            $pre_result->bindValue(1, $vehicule->getId(), SQLITE3_INTEGER);
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
