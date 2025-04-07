<?php

namespace Fulll\Infra\Repositories;

class SqLiteLocationRepository
{
    public function findIdByGpsCoordinates(string $gps_coordinates): ?int
    {
        try {
            $db = new \SQLite3($_ENV['DB_PATH']);

            $stmt = $db->prepare('SELECT id FROM locations WHERE gps_coordinates = :gps_coordinates');
            $stmt->bindValue(':gps_coordinates', $gps_coordinates, SQLITE3_TEXT);
            $result = $stmt->execute();

            $row = $result->fetchArray(SQLITE3_ASSOC);

            return $row ? (int) $row['id'] : null;
        } catch (\Exception $e) {
            echo 'Error: '.$e->getMessage();

            return false;
        }

        $db->close();
    }
}
