<?php declare(strict_types=1);

namespace CnbApi\Exceptions;

class EntityNotFoundException extends RuntimeException
{
    public function __construct(string $method, array $ids = [])
    {
        $message = "Entity in '$method' with ids [" . implode(',', $ids) . "] not found";

        parent::__construct($message);
    }
}
