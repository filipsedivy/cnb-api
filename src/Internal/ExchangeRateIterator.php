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

use CnbApi\Entity\ExchangeRate;

class ExchangeRateIterator extends ObjectIterator
{
    const COLUMN_CURRENCY_CODE = 'column_currency_code';
    const COLUMN_CURRENCY_NAME = 'column_currency_name';
    const COLUMN_RATE = 'column_rate';
    const COLUMN_ONE_RATE = 'column_one_rate';


    /**
     * @return ExchangeRate|object|null
     */
    public function fetch()
    {
        return parent::fetch();
    }


    /**
     * @return ExchangeRate[]
    */
    public function fetchAll()
    {
        return parent::fetchAll();
    }


    /**
     * @param ExchangeRate[]|array $list
     */
    protected function applyConditionals(&$list = array())
    {
        $result_list = array();

        if (empty($this->conditionals))
        {
            $result_list = $this->list;
        }
        else
        {
            foreach ($this->conditionals as $conditional)
            {
                list($column, $value, $statement) = $conditional;

                foreach ($this->list as $item)
                {
                    if (!$item instanceof ExchangeRate) continue;
                    if ($this->testStatement($item, $column, $value, $statement)
                        && !$this->objectExistsInArray($item, $result_list))
                    {
                        $result_list[] = $item;
                    }
                }
            }
        }

        if (!is_null($this->limit))
        {
            $offset = is_null($this->offset) ? 0 : $this->offset;
            $limit = $offset == 0 ? $this->limit : $this->limit + $offset;
            $clone_list = $result_list;
            $result_list = array();

            for ($i = $offset; $i < $limit; $i++)
            {
                $result_list[] = $clone_list[$i];
            }
        }

        $list = $result_list;
    }


    /**
     * @param ExchangeRate $entity
     * @param string       $column
     * @param string       $value
     * @param string       $statement
     *
     * @return bool|null
     */
    private function testStatement(ExchangeRate $entity, $column, $value, $statement)
    {
        $column_value = null;
        switch ($column)
        {
            case self::COLUMN_RATE:
                $column_value = $entity->getRate();
                break;

            case self::COLUMN_CURRENCY_CODE:
                $column_value = $entity->getCurrency()->getCode();
                break;

            case self::COLUMN_CURRENCY_NAME:
                $column_value = $entity->getCurrency()->getName();
                break;

            case self::COLUMN_ONE_RATE:
                $column_value = $entity->getOneRateAmount();
                break;

            default:
                throw new \LogicException('Column \'' . $column . '\' is not implement');
                break;
        }

        $result = null;

        switch ($statement)
        {
            case self::STATEMENT_EQUALS:
                $result = ($value == $column_value);
                break;

            default:
                throw new \LogicException('Statement \'' . $statement . '\' is not implement');
                break;
        }

        return $result;
    }


    /**
     * @param ExchangeRate[]|array $input
     *
     * @return ExchangeRateIterator
     */
    public static function create($input)
    {
        $object = new self();

        if ($input instanceof ExchangeRate)
        {
            $object->list = array($input);
        }
        elseif (is_array($input))
        {
            $entities = array();
            foreach ($input as $row)
            {
                if ($row instanceof ExchangeRate) $entities[] = $row;
            }
            $object->list = $entities;
        }

        return $object;
    }


    /**
     * @return array
     */
    protected function getColumns()
    {
        return $this->getConstantsList('COLUMN_');
    }


    /**
     * @return array
     */
    protected function getConstants()
    {
        $reflection = new \ReflectionClass(__CLASS__);
        return $reflection->getConstants();
    }
}