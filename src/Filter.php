<?php

namespace Railken\ApiHelpers;

use Railken\ApiHelpers\Exceptions as Exceptions;

class Filter
{

    protected $only = [];

    public function __construct($only = [])
    {
        $this->only = $only;
    }

    /**
     * Convert the string query into an object (e.g.) 
     *
     * @param string $query (e.g.) title eq 'something' 
     *
     * @return Object
     */
    public function transform($query)
    {

        $filter = "(".$query.")";
        $buffer_string = "";

        try {

            $node = new FilterSupportNode();
            $in_string = false;
            $escape = false;

            foreach (str_split($filter) as $char) {

                if ($char == "\\") {
                    $escape = !$escape;
                }

                if ($char == "\"" && !$escape) {
                    $in_string = !$in_string;
                }

                if ($in_string) {

                    $buffer_string .= $char;
                } else {

                    switch ($char) {

                        case  "(": 
                            if (!empty(trim($buffer_string)))
                                $node->parts[] = $buffer_string;

                            $new = new FilterSupportNode();
                            $new->parent = $node;
                            $new->parent->childs[] = $new;
                            $node = $new;
                            $buffer_string = "";

                        break;

                        case ")":

                            if (!empty(trim($buffer_string)))
                                $node->parts[] = $buffer_string;


                            # // Going up? Resolving current parts.

                            $current_operator = null;
                            $current_key = null;
                            $current_value = null;
                            $last_logic_operator = "and";

                            // 
                            $subs = [];

                            foreach ($node->parts as $part) {

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

                                    if ($current_value[0] == "\"")
                                        $current_value = substr($current_value, 1, -1);

                                    if ($current_operator == "in")
                                        $current_value = explode(",", $current_value);

                                    $subs[] = new FilterNode($current_key, $current_operator, $current_value);
                                }
                            }



                            $node->value = array_merge($node->childs, $subs);
                            $node->operator = $last_logic_operator;
                            $child = $node;
                            $node = $node->parent;
                            $buffer_string = "";

                        break;

                        case " ":
                            if (!empty(trim($buffer_string)))
                                $node->parts[] = $buffer_string;

                            $buffer_string = "";
                        break;

                        default:

                            $buffer_string .= $char;
                        break;

                    }

                }

                if ($char != "\\") {
                    $escape = false;
                }
            }


            if ($in_string) {
                throw new Exceptions\FilterSyntaxException($string);
            }

            return $node->childs[0];
        
        } catch (\Exception $e) {
            throw new Exceptions\FilterSyntaxException($string);
        }
    }
}