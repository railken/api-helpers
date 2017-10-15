<?php

namespace Railken\ApiHelpers;

class FilterSupportNode
{

    /**
     * Parts
     *
     * @var array
     */
    public $parts = [];

    /*
     * Parent
     *
     * @var FilterSupportNode
     */
    private $parent;

    /**
     * Set parent node
     *
     * @param FilterSupportNode $node
     *
     * @return void
     */
    public function setParent(FilterSupportNode $node)
    {
        $this->parent = $node;
    }

    /**
     * Get parent
     *
     * @return FilterSupportNode
     */
    public function getParent()
    {
        return $this->parent;
    }
}
