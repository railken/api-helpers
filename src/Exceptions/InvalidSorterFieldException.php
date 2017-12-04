<?php

namespace Railken\ApiHelpers\Exceptions;

use Exception;

class InvalidSorterFieldException extends Exception
{
    public function __construct($field)
    {
        $this->message = sprintf("Invalid field '%s'", $field);
    }
}
