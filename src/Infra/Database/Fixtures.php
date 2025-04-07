<?php

$database = new \SQLite3(__DIR__ . '/my_database.db', SQLITE3_OPEN_READWRITE);

if (!$database) {
    echo "Failed to connect to the database.\n";
    exit;
}

echo "Inserting fixtures...\n";

// Enable foreign key constraints
$database->exec('PRAGMA foreign_keys = ON');

// Clear existing data
$database->exec("DELETE FROM fleets_vehicules");
$database->exec("DELETE FROM vehicules");
$database->exec("DELETE FROM locations");
$database->exec("DELETE FROM fleets");

// Insert into fleets
$database->exec("INSERT INTO fleets (id, name) VALUES (1, 'Fleet A'), (2, 'Fleet B')");

// Insert into locations
$database->exec("INSERT INTO locations (id, gpsCoordinates) VALUES (1, '48.8566,2.3522'), (2, '40.7128,-74.0060')");

// Insert into vehicules
$database->exec("INSERT INTO vehicules (id, location_id) VALUES (1, 1), (2, 2), (3, 1)");

// Insert fleet-vehicule relationships
$database->exec("INSERT INTO fleets_vehicules (fleet_id, vehicule_id) VALUES (1, 1), (1, 3)");

// At this point:
// - Vehicule 1 and 3 are in Fleet A
// - Vehicule 2 is UNREGISTERED

echo "Fixtures inserted successfully ✅\n";

$database->close();
