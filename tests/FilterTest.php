<?php

use PHPUnit\Framework\TestCase;
use Railken\ApiHelpers\Filter;


class FilterTest extends TestCase
{


    public function testBasic()
    {   
    
        $filter = new Filter();

        $this->assertEquals(json_decode('{"key":null,"operator":"or","value":[{"key":null,"operator":"or","value":[{"key":"title","operator":"eq","value":"something"},{"key":"rating","operator":"gt","value":"3"}]},{"key":null,"operator":"or","value":[{"key":"title","operator":"eq","value":"something else"},{"key":"rating","operator":"lt","value":"3"}]},{"key":"title","operator":"eq","value":"another"}]}'), json_decode(json_encode($filter->convert('(title eq "something" or rating gt 3) or (title eq "something else" or rating lt 3) or title eq "another"'))));
    }
}