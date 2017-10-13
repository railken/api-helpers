<?php

use PHPUnit\Framework\TestCase;
use Railken\ApiHelpers\Sorter;

class SorterTest extends TestCase
{

    /**
     * @expectedException Railken\ApiHelpers\Exceptions\InvalidSorterDirectionException
     */
    public function testInvalidSorterDirectionException()
    {
        $sorter = new Sorter();
        $sorter->add('id', 'invalid value');
    }

    public function testValues()
    {   
        $sorter = new Sorter();
        $sorter->add('id', 'asc');
        $this->assertEquals('id', $sorter->get()->first()->getName());
        $this->assertEquals('asc', $sorter->get()->first()->getDirection());
    }
}