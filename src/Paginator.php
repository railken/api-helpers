<?php

namespace Railken\ApiHelpers;

use Railken\ApiHelpers\Contracts\PaginatorContract;

use Railken\Bag;

class Paginator implements PaginatorContract
{

    /**
     * Retrieve the information about pagination
     *
     * @param integer $total
     *
     * @return $this
     */
    public function paginate($total, $page = 1, $take = 10)
    {
        $take = (int)$take;
        $page = (int)$page;

        $take <= 0 && $take = 10;
        $page <= 0 && $page = 1;

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
