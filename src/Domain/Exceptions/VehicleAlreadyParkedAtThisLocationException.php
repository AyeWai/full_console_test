<?php

declare(strict_types=1);

namespace Fulll\Domain\Exception;

final class VehicleAlreadyParkedAtThisLocationException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Vehicle is already parked at this location.");
    }
}
