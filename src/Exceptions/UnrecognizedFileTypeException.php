<?php

namespace GlobalCode\LaravelCatalog\Exceptions;

use Exception;

class UnrecognizedFileTypeException extends Exception
{
    protected $message = 'Unrecognized file type. Please, check file extension.';
}
