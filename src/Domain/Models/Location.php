<?php

declare(strict_types=1);

namespace Fulll\Domain\Models;

final class Location
{
    public function __construct(
        private ?int $id = null,
        private string $gpsCoordinates,
        private ?string $alt = null,
    ) {
    }
}
