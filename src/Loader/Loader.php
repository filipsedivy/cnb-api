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

namespace CnbApi\Loader;

use InvalidArgumentException;
use LogicException;

class Loader
{
    /**
     * @var Request
     */
    private $request;


    /**
     * @var int
     */
    private $timeout;


    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setTimeout(5);
    }


    /**
     * @return bool|string
     */
    public function getContent()
    {
        $url = $this->request->getUrl();
        $ctx = $this->getCtx();
        $content = @file_get_contents($url, false, $ctx);
        if ($content === false)
        {
            throw new LogicException('Network connection not available');
        }

        return $content;
    }


    /**
     * @param int $value
     */
    public function setTimeout($value)
    {
        if (!is_int($value)) throw new InvalidArgumentException('Timeout is not int. Value is ' . gettype($value));
        $this->timeout = $value;
    }


    /**
     * @return resource
     */
    private function getCtx()
    {
        return stream_context_create(array(
            'http' => array(
                'timeout' => $this->timeout,
                'ignore_errors' => true
            )
        ));
    }
}