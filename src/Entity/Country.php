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

class Country
{
    /**
     * @var string
     */
    private $name;


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
     * @param $name
     *
     * @return Country
     */
    public static function create($name)
    {
        $object = new self();
        $object->setName($name);
        return $object;
    }


    /**
     * @param array $data
     *
     * @return Country
     */
    public static function createFromArray(array $data)
    {
        return self::create(
            $data['name']
        );
    }
}