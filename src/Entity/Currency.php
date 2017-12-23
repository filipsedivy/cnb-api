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

namespace CnbApi\Entity;

class Currency
{
    /**
     * @var string
     */
    private $name;


    /**
     * @var string
     */
    private $code;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }


    /**
     * @param $name
     * @param $code
     *
     * @return Currency
     */
    public static function create($name, $code)
    {
        $object = new self();
        $object->setName($name);
        $object->setCode($code);
        return $object;
    }


    /**
     * @param array $data
     *
     * @return Currency
     */
    public static function createFromArray(array $data)
    {
        return self::create(
            $data['name'],
            $data['code']
        );
    }
}