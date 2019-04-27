<?php

declare(strict_types=1);

namespace CnbApi\Helpers;

use CnbApi\CoreException;

class Http
{
    /** @var string */
    private $url;

    /** @var string */
    private $content;

    /** @var array */
    private $contextOptions = [];


    /**
     * @param string $url
     * @param bool $defaultContextOptions
     */
    public function __construct(string $url, bool $defaultContextOptions = true)
    {
        $this->url = $url;

        if ($defaultContextOptions)
        {
            $this->setDefaultContextOptions();
        }
    }


    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): Http
    {
        $this->url = $url;

        return $this;
    }


    /**
     * @param string $group
     * @param string $name
     * @param string $value
     *
     * @return Http
     */
    public function addContextOptions(string $group, string $name, string $value): Http
    {
        $this->contextOptions[$group][$name] = $value;

        return $this;
    }


    /**
     * @return string
     *
     * @throws CoreException
     */
    public function getContent(): string
    {
        if ($this->content === null)
        {
            $this->loadContent();
        }

        return $this->content;
    }


    /**
     * @return void
     *
     * @throws CoreException
     */
    private function loadContent(): void
    {
        $context = stream_context_create($this->contextOptions);

        $content = file_get_contents($this->url, false, $context);

        if ($content === false)
        {
            throw new CoreException('Content is empty');
        }

        $this->content = $content;
    }


    private function setDefaultContextOptions(): void
    {
        // Set timout to 10 seconds
        $this->addContextOptions('http', 'timeout', '10');
    }
}