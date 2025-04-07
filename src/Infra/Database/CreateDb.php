<?php

$database = new SQLite3(__DIR__.'/my_database.db');

if ($database) {
    echo "Database connected successfully!\n";

    $database->exec('PRAGMA foreign_keys = ON');

    $createFleetTableQuery = 'CREATE TABLE IF NOT EXISTS fleets (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(45)
    )';

    $createLocationTableQuery = 'CREATE TABLE IF NOT EXISTS locations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        gps_coordinates VARCHAR(50) NOT NULL,
        alt VARCHAR(50)
    )';

    $createVehicleTableQuery = 'CREATE TABLE IF NOT EXISTS vehicles (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        plate_number VARCHAR(50) UNIQUE
    )';

    $createFleetVehicleTableQuery = 'CREATE TABLE IF NOT EXISTS fleets_vehicles (
        fleet_id INTEGER NOT NULL,
        vehicle_id INTEGER Not NULL,
        PRIMARY KEY (vehicle_id, fleet_id),
        FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
        FOREIGN KEY (fleet_id) REFERENCES fleets(id) ON DELETE CASCADE
    )';

    $createVehicleLocationTableQuery = 'CREATE TABLE IF NOT EXISTS vehicles_locations (
        vehicle_id INTEGER,
        location_id INTEGER,
        PRIMARY KEY(vehicle_id),
        FOREIGN KEY(vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE,
        FOREIGN KEY(location_id) REFERENCES locations(id) ON DELETE CASCADE
    )';

    $createVehicleRegistrationStatusViewQuery = "CREATE VIEW vehicle_registration_status AS
        SELECT 
            v.plate_number AS plate_number,
            CASE 
                WHEN f.fleet_id IS NULL THEN 'UNREGISTERED'
                ELSE 'REGISTERED'
            END AS registration_status,
            f.fleet_id AS associated_fleet
        FROM vehicles v
        LEFT JOIN fleets_vehicles f ON f.vehicle_id = v.id";

    $createVehicleLocationViewQuery = 'CREATE VIEW IF NOT EXISTS vehicle_location_view AS
        SELECT 
            v.plate_number,
            l.gps_coordinates,
            l.alt
        FROM vehicles v
        JOIN vehicles_locations vl ON v.id = vl.vehicle_id
        JOIN locations l ON vl.location_id = l.id';

    try {
        $database->exec($createFleetTableQuery);
        echo "Fleet table created successfully!\n";
    } catch (Error $e) {
        echo 'Error creating fleet table: '.$e->getMessage()."\n";
    }

    try {
        $database->exec($createLocationTableQuery);
        echo "Locations table created successfully!\n";
    } catch (Error $e) {
        echo 'Error creating locations table: '.$e->getMessage()."\n";
    }

    try {
        $database->exec($createVehicleTableQuery);
        echo "Vehicle table created successfully!\n";
    } catch (Error $e) {
        echo 'Error creating vehicle table: '.$e->getMessage()."\n";
    }

    try {
        $database->exec($createFleetVehicleTableQuery);
        echo "Fleet vehicle table created successfully!\n";
    } catch (Error $e) {
        echo 'Error creating fleet vehicle table: '.$e->getMessage()."\n";
    }

    try {
        $database->exec($createVehicleLocationTableQuery);
        echo "Vehicle location table created successfully!\n";
    } catch (Error $e) {
        echo 'Error creating Vehicle location table: '.$e->getMessage()."\n";
    }

    try {
        $database->exec($createVehicleRegistrationStatusViewQuery);
        echo "Vehicle registration status view created successfully!\n";
    } catch (Error $e) {
        echo 'Error creating vehicle registration status view: '.$e->getMessage()."\n";
    }

    try {
        $database->exec($createVehicleLocationViewQuery);
        echo "Vehicle location view created successfully!\n";
    } catch (Error $e) {
        echo 'Error creating vehicle location view: '.$e->getMessage()."\n";
    }
} else {
    echo "Failed to connect to the database.\n";
}

$database->close();
