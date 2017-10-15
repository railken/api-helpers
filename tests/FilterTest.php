<?php

use PHPUnit\Framework\TestCase;
use Railken\ApiHelpers\Filter;


class FilterTest extends TestCase
{

    public function testBasic()
    {   
        $this->assertEquals(Filter::class, get_class(new Filter()));
    }
}