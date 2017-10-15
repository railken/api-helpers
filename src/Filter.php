<?php

namespace Railken\ApiHelpers;

use Railken\ApiHelpers\Exceptions as Exceptions;

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
    public function convert($query)
    {
        return (new QueryConverter($query))->convert();
    }
}
