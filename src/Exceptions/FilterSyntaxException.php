<?php

namespace Railken\ApiHelpers\Exceptions;

use Exception;

class FilterSyntaxException extends Exception
{
    public function __construct($filter)
    {
        $this->message = sprintf("Syntax error in %s", $filter);
    }
}
