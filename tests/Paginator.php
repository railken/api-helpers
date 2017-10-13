<?php

namespace Railken\ApiHelpers\Tests;

use Railken\ApiHelpers\Paginator as BasePaginator;

class Paginator extends BasePaginator
{

	public function count($query)
	{
		// We should use the query passed to count the results;

		return 999;
	}
}