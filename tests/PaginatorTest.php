<?php

use PHPUnit\Framework\TestCase;
use Railken\ApiHelpers\Paginator;


class PaginatorTest extends TestCase
{


    public function testLastPage()
    {   
        $paginator = new Paginator();
        $pagination = $paginator->paginate(999, 100, 10);

        $this->assertEquals(999, $pagination->total);
        $this->assertEquals(10, $pagination->take);
        $this->assertEquals(100, $pagination->page);
        $this->assertEquals(100, $pagination->pages);
        $this->assertEquals(990, $pagination->skip);
        $this->assertEquals(991, $pagination->from);
        $this->assertEquals(999, $pagination->to);

    }

    public function testFirstPage()
    {   
        $paginator = new Paginator();
        $pagination = $paginator->paginate(999, 1, 10);

        $this->assertEquals(999, $pagination->total);
        $this->assertEquals(10, $pagination->take);
        $this->assertEquals(1, $pagination->page);
        $this->assertEquals(100, $pagination->pages);
        $this->assertEquals(0, $pagination->skip);
        $this->assertEquals(1, $pagination->from);
        $this->assertEquals(10, $pagination->to);
    }

    public function testSecondPage()
    {   
        $paginator = new Paginator();
        $pagination = $paginator->paginate(999, 2, 10);

        $this->assertEquals(999, $pagination->total);
        $this->assertEquals(10, $pagination->take);
        $this->assertEquals(2, $pagination->page);
        $this->assertEquals(100, $pagination->pages);
        $this->assertEquals(10, $pagination->skip);
        $this->assertEquals(11, $pagination->from);
        $this->assertEquals(20, $pagination->to);
    }

    public function testMidPage()
    {   
        $paginator = new Paginator();
        $pagination = $paginator->paginate(999, 51, 10);

        $this->assertEquals(999, $pagination->total);
        $this->assertEquals(10, $pagination->take);
        $this->assertEquals(51, $pagination->page);
        $this->assertEquals(100, $pagination->pages);
        $this->assertEquals(500, $pagination->skip);
        $this->assertEquals(501, $pagination->from);
        $this->assertEquals(510, $pagination->to);
    }
}