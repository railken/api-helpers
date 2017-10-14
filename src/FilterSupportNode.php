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

	public function setParent(FilterSupportNode $node)
	{
		$this->parent = $node;
	}

	public function getParent()
	{
		return $this->parent;
	}
}