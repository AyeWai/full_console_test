<?php

$database = new \SQLite3(__DIR__ . '/my_database.db');

if ($database) {
    echo "Database connected successfully!\n";

    $database->exec('PRAGMA foreign_keys = ON');

    $createFleetTableQuery = "CREATE TABLE IF NOT EXISTS fleets (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(45)
    )";

    $createLocationTableQuery = "CREATE TABLE IF NOT EXISTS locations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        gpsCoordinates VARCHAR(20) NOT NULL
    )";

    $createVehiculeTableQuery = "CREATE TABLE IF NOT EXISTS vehicules (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        location_id INTEGER,
        FOREIGN KEY (location_id) REFERENCES locations(id)
    )";

    $createFleetVehiculeTableQuery = "CREATE TABLE IF NOT EXISTS fleets_vehicules (
        fleet_id INTEGER NOT NULL,
        vehicule_id INTEGER NOT NULL,
        PRIMARY KEY (vehicule_id, fleet_id),
        FOREIGN KEY (vehicule_id) REFERENCES vehicules(id) ON DELETE CASCADE
        FOREIGN KEY (fleet_id) REFERENCES fleets(id) ON DELETE CASCADE
    )";

    $createVehiculeRegistrationStatusViewQuery = "CREATE VIEW vehicule_registration_status AS
        SELECT 
            v.id,
            CASE 
                WHEN f.fleet_id IS NULL THEN 'UNREGISTERED'
                ELSE 'REGISTERED'
            END AS registration_status,
            f.fleet_id AS associated_fleet
        FROM vehicules v
        LEFT JOIN fleets_vehicules f ON f.vehicule_id = v.id";

    try {
        $database->exec($createFleetTableQuery);
        echo "Fleet table created successfully!\n";
    } catch (Error $e) {
        echo "Error creating fleet table: " . $e->getMessage() . "\n";
    }

    try {
        $database->exec($createLocationTableQuery);
        echo "Locations table created successfully!\n";
    } catch (Error $e) {
        echo "Error creating locations table: " . $e->getMessage() . "\n";
    }

    try {
        $database->exec($createVehiculeTableQuery);
        echo "Vehicule table created successfully!\n";
    } catch (Error $e) {
        echo "Error creating vehicule table: " . $e->getMessage() . "\n";
    }

    try {
        $database->exec($createFleetVehiculeTableQuery);
        echo "Fleet vehicule table created successfully!\n";
    } catch (Error $e) {
        echo "Error creating fleet vehicule table: " . $e->getMessage() . "\n";
    }

    try {
        $database->exec($createVehiculeRegistrationStatusViewQuery);
        echo "Vehicule registration status view created successfully!\n";
    } catch (Error $e) {
        echo "Error creating vehicule registration status view: " . $e->getMessage() . "\n";
    }
} else {
    echo "Failed to connect to the database.\n";
}

$database->close();
