<?php

namespace Railken\ApiHelpers;

class FilterNode
{

	/**
	 * Key/Attribute 
	 *
	 * @param string
	 */
	public $key;

	/**
	 * Operator of node
	 *
	 * @var string
	 */
	public $operator;

	/**
	 * Value/Values of node
	 *
	 * @var mixed
	 */
	public $value;

	/**
	 * Construct
	 *
	 * @param string $key
	 * @param string $operator
	 * @param mixed $value
	 */
	public function __construct() 
	{

	}

	/**
	 * Set key
	 *
	 * @param string $key
	 *
	 * @return $this
	 */
	public function setKey($key)
	{
		$this->key = $key;

		return $this;
	}

	/**
	 * Set value
	 *
	 * @param mixed $value
	 *
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}

	/**
	 * Set Operator
	 *
	 * @param string $operator
	 *
	 * @return $this
	 */
	public function setOperator($operator)
	{
		$this->operator = $operator;

		return $this;
	}

	/**
	 * Create a new instance using node supporrt
	 *
	 * @param FilterSupportNode $support_node
	 *
	 * @return FilterNode
	 */
	public static function factory(FilterSupportNode $support_node)
	{
    	return static::newBySupportNode($support_node);
	}

	/**
	 * Create a new node from support node
	 *
	 * @param FilterSupportNode $support_node
	 *
	 * @return Node
	 */
	public static function newBySupportNode($support_node)
	{
		$current_operator = null;
        $current_key = null;
        $current_value = null;
        $last_logic_operator = "and";
 
        $subs = [];

        $node = new FilterNode();


        foreach ($support_node->parts as $part) {

        	if ($part instanceof FilterSupportNode) {
        		$subs[] = static::newBySupportNode($part);
        	} else {
        		if (in_array($part, ['or', 'and'])) {

	                $current_key = null;
	                $current_value = null;
	                $current_operator = null;
	                $last_logic_operator = $part;
	            } else if (in_array($part, ['eq', 'gt', 'lt', 'in', 'contains'])) {

	                if ($current_key !== null)
	                    $current_operator = $part;
	            } else {

	                if ($current_key !== null && $current_value == null) {
	                    $current_value = $part;
	                }

	                if ($current_key == null) {
	                    $current_key = $part;
	                }

	            }

	            if ($current_key !== null && $current_operator !== null && $current_value !== null) {

	                # Remove '"' if present
	                if ($current_value[0] == "\"")
	                    $current_value = substr($current_value, 1, -1);

	                # Explode into array if operator "in"
	                if ($current_operator == "in")
	                    $current_value = explode(",", $current_value);

	                $subs[] = (new FilterNode())->setKey($current_key)->setOperator($current_operator)->setValue($current_value);
	            }
        	}
   
        }

        $node->operator = $last_logic_operator;
        $node->value = $subs;

        return $node;

	}

}