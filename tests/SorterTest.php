<?php

use PHPUnit\Framework\TestCase;
use Railken\ApiHelpers\Sorter;

class SorterTest extends TestCase
{
    /**
     * @expectedException Railken\ApiHelpers\Exceptions\InvalidSorterFieldException
     */
    public function testInvalidSorterFieldException()
    {
        $sorter = new Sorter();
        $sorter->setKeys(['id']);
        $sorter->add('invalid field', 'asc');
    }


    /**
     * @expectedException Railken\ApiHelpers\Exceptions\InvalidSorterDirectionException
     */
    public function testInvalidSorterDirectionException()
    {
        $sorter = new Sorter();
        $sorter->setKeys(['id']);
        $sorter->add('id', 'invalid value');
    }

    public function testValues()
    {   
        $sorter = new Sorter();
        $sorter->setKeys(['id']);
        $sorter->add('id', 'asc');
        $this->assertEquals('id', $sorter->get()->first()->getName());
        $this->assertEquals('asc', $sorter->get()->first()->getDirection());
    }
}