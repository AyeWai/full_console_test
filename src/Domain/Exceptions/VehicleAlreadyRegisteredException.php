<?php

declare(strict_types=1);

namespace Fulll\Domain\Exceptions;

final class VehiculeAlreadyRegisteredException extends DomainException
{
    public function __construct(string $message = 'This vehicule has already been registered into your fleet.')
    {
        parent::__construct($message);
    }
}
