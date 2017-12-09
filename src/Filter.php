<?php

namespace Railken\ApiHelpers;

use Railken\ApiHelpers\Exceptions as Exceptions;
use Railken\SQ\QueryParser;
use Railken\SQ\Resolvers as Resolvers;

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
        $parser = new QueryParser();
        $parser->addResolvers([
            new Resolvers\GroupingResolver(),
            new Resolvers\NotEqResolver(),
            new Resolvers\EqResolver(),
            new Resolvers\LtResolver(),
            new Resolvers\LteResolver(),
            new Resolvers\GtResolver(),
            new Resolvers\GteResolver(),
            new Resolvers\CtResolver(),
            new Resolvers\SwResolver(),
            new Resolvers\NotInResolver(),
            new Resolvers\InResolver(),
            new Resolvers\EwResolver(),
            new Resolvers\AndResolver(),
            new Resolvers\OrResolver(),
        ]);

        return $parser->parse($query);
    }
}
