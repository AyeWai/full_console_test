<?php

namespace Fulll\Infra\Repositories;

class SqLiteVehicleRepository
{
    public function findIdByPlateNumber(string $plateNumber): ?int
    {
        try {
            $db = new \SQLite3($_ENV['DB_PATH']);

            $stmt = $this->db->prepare('SELECT id FROM vehicles WHERE plate_number = :plate');
            $stmt->bindValue(':plate', $plateNumber, SQLITE3_TEXT);
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
