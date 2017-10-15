<?php

namespace Railken\ApiHelpers;

use Railken\Bag;
use Illuminate\Support\Collection;

class Sorter
{

    /**
     * List of sorting values
     *
     * @var Collection
     */
    protected $values;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->values = new Collection();
    }

    /**
     * Perform the query and retrieve the information about pagination
     *
     * @param string $name
     * @param string $direction
     *
     * @return $this
     */
    public function add($name, $direction)
    {
        $field = new SorterField();
        $field->setName($name);
        $field->setDirection($direction);

        $this->values[] = $field;
    }

    /**
     * Retrieve all sorting values
     *
     * @return Collection
     */
    public function get()
    {
        return $this->values;
    }
}
