<?php

namespace Railken\ApiHelpers;

use Railken\ApiHelpers\Contracts\PaginatorContract;

use Railken\Bag;

abstract class Paginator implements PaginatorContract
{

    /**
     * Perform the query and retrieve the information about pagination
     *
     * @return $this
     */
    public function paginate($query, $page = 1, $take = 10)
    {
        $take = (int)$take;
        $page = (int)$page;

        $take <= 0 && $take = 10;
        $page <= 0 && $page = 1;

        $total = $this->count($query);

        $skip = ($page - 1) * $take;
        $last = $skip + $take;
        $first = $skip+1;

        if ($last > $total) {
            $last = $total;
        }

        $bag = new Bag();

        $bag->set('total', $total);
        $bag->set('skip', $skip);
        $bag->set('take', $take);
        $bag->set('from', $first);
        $bag->set('to', $last);
        $bag->set('page', $page);
        $bag->set('pages', (ceil($total / $take)));

        return $bag;
    }

}
