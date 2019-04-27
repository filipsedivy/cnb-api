<?php

declare(strict_types=1);

namespace CnbApi;

class CoreException extends \Exception
{

}

class IOException extends CoreException
{

}

class DateTimeException extends CoreException
{

}

class RuntimeException extends CoreException
{

}

class InvalidArgumentException extends CoreException
{

}