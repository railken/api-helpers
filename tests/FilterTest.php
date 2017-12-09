<?php

use PHPUnit\Framework\TestCase;
use Railken\ApiHelpers\Filter;
use Railken\SQ\Nodes as Nodes;


class FilterTest extends TestCase
{

    public function testBasic()
    {   
        $filter = new Filter();

        $result = $filter->parse('x eq 1');
        $this->assertEquals(Nodes\EqNode::class, get_class($result));
        $this->assertEquals('x', $result->getKey());
        $this->assertEquals('1', $result->getValue());
    }
}