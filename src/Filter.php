<?php

namespace Railken\ApiHelpers;

use Railken\ApiHelpers\Exceptions as Exceptions;
use Railken\SQ\QueryParser;

class Filter
{

    /**
     * Construct
     */
    public function __construct()
    {
    }

    /**
     * Convert the string query into an object (e.g.)
     *
     * @param string $query (e.g.) title eq 'something'
     *
     * @return Object
     */
    public function parse($query)
    {
        return (new QueryParser())->parse($query);
    }
}
