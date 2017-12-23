<?php
/**
 * This file is part of the CnbApi package.
 *
 * (c) Filip Sedivy <mail@filipsedivy.cz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT
 * @author  Filip Sedivy <mail@filipsedivy.cz>
 */

namespace CnbApi\Internal;

abstract class ObjectIterator
{
    const STATEMENT_EQUALS = '=';
    const STATEMENT_GREATER_THAN = '>';
    const STATEMENT_LESS_THAN = '<';
    const STATEMENT_RANGE = '(..)';


    /**
     * @var array
     */
    protected $list = array();


    /**
     * @var array
     */
    protected $conditionals = array();


    /**
     * @var null|int
     */
    protected $limit = null;


    /**
     * @var null|int
     */
    protected $offset = null;


    /**
     * @return array
     */
    abstract protected function getColumns();


    /**
     * @return array
     */
    abstract protected function getConstants();


    public function setLimit($value)
    {
        if (!is_scalar($value)) throw new \InvalidArgumentException('Value must be a int. Value type is \'' . gettype($value) . '\'');
        $this->limit = $value;
        return $this;
    }


    public function setOffset($value)
    {
        if (!is_scalar($value)) throw new \InvalidArgumentException('Value must be a int. Value type is \'' . gettype($value) . '\'');
        $this->offset = $value;
        return $this;
    }


    /**
     * @return array|null
     */
    public function fetchAll()
    {
        $this->applyConditionals($list);
        return $list;
    }

    /**
     * @return object|null
     */
    public function fetch()
    {
        if (is_null($this->limit)) $this->setLimit(1);
        $list = $this->fetchAll();
        return $list[0];
    }


    public function addEqual($column, $value)
    {
        if (!is_scalar($value)) throw new \InvalidArgumentException('Value must be a scalar. Value type is \'' . gettype($value) . '\'');
        $this->addCondition($column, $value, self::STATEMENT_EQUALS);
        return $this;
    }


    private function addCondition($column, $value, $statement)
    {
        if (!in_array($column, $this->getColumns()))
        {
            throw new \InvalidArgumentException('The column is not from the allowed values: ' . implode(', ', $this->getColumns()));
        }

        $this->conditionals[] = array($column, $value, $statement);
    }


    protected function getConstantsList($start)
    {
        $list = array();
        $constants = $this->getConstants();

        foreach ($constants as $key => $value)
        {
            if (strpos($key, $start) !== false) $list[$key] = $value;
        }

        return $list;
    }


    protected function applyConditionals(&$list)
    {
        throw new \LogicException('Method ' . __METHOD__ . ' is not implement');
    }


    /**
     * @param object $object
     * @param array  $array
     *
     * @return bool
     */
    protected function objectExistsInArray($object, array $array)
    {
        $value_object = new ValueObject($object);

        foreach ($array as $item)
        {
            $first_object = new ValueObject($item);
            if ($value_object->serialize() == $first_object->serialize())
            {
                return true;
            }
        }
        return false;
    }


    /**
     * @param array $input
     *
     * @return ObjectIterator
     */
    public static function create($input)
    {
        throw new \LogicException('Method ' . __METHOD__ . ' is not implement');
    }
}