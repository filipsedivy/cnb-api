<?php declare(strict_types=1);

namespace CnbApi\Exceptions;

use Exception;
use Throwable;

class IOException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
