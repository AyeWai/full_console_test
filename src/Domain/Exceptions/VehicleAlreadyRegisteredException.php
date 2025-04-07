<?php

declare(strict_types=1);

namespace Fulll\Domain\Exceptions;

final class VehicleAlreadyRegisteredException extends DomainException
{
    public function __construct(string $message = 'This vehicle has already been registered into your fleet.')
    {
        parent::__construct($message);
    }
}
