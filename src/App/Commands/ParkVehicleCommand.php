<?php

declare(strict_types=1);

namespace Fulll\App\Commands;

use Fulll\Domain\Models\Vehicle;

final class ParkVehicleCommand
{
    public function __construct(
        private Vehicle $vehicle,
        private int $fleet_id,
        private int $location_id,
        private string $gpsCoordinates,
        private ?string $alt = null,
    ) {
    }

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    public function getFleetId(): int
    {
        return $this->fleet_id;
    }

    public function setFleetId(int $fleet_id): void
    {
        $this->fleet_id = $fleet_id;
    }

    public function getLocationId(): int
    {
        return $this->location_id;
    }

    public function setLocationId(int $location_id): void
    {
        $this->location_id = $location_id;
    }

    public function getGpsCoordinates(): string
    {
        return $this->gpsCoordinates;
    }

    public function setGpsCoordinates(string $gpsCoordinates): void
    {
        $this->gpsCoordinates = $gpsCoordinates;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }
}
