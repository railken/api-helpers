<?php

namespace Railken\ApiHelpers\Contracts;

interface PaginatorContract
{
	public function count($query);
}