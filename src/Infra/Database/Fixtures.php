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
$database->exec("DELETE FROM fleets_vehicles");
$database->exec("DELETE FROM vehicles");
$database->exec("DELETE FROM locations");
$database->exec("DELETE FROM fleets");

// Insert into fleets
$database->exec("INSERT INTO fleets (name) VALUES ('Fleet A'), (null)");

// Insert into locations
$database->exec("INSERT INTO locations (gps_coordinates, alt) VALUES ('48.8566,2.3522', null), ('40.7128,-74.0060', '15')");

// Insert into vehicles
$database->exec("INSERT INTO vehicles (plate_number) VALUES ('AX2-DI3'), ('B5Y-78D'), ('R3N-0LT')");

// Insert fleet-vehicle relationships
$database->exec("INSERT INTO fleets_vehicles (fleet_id, vehicle_id) VALUES (1, 1), (1, 3)");

// Insert fleet-vehicle relationships
$database->exec("INSERT INTO vehicles_locations (vehicle_id, location_id) VALUES (1, 1), (2, 2)");

echo "Fixtures inserted successfully ✅\n";

$database->close();
