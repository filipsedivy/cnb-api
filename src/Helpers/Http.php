<?php declare(strict_types=1);

namespace CnbApi\Helpers;

use CnbApi\Exceptions;

class Http
{
    /** @var string */
    private $url;

    /** @var string */
    private $content;

    /** @var ContextOptions */
    private $contextOptions;

    public static function createWithDefaultContextOptions(string $url): self
    {
        return new self($url, static function (ContextOptions $contextOptions) {
            $contextOptions->add('http', 'timeout', '10');
        });
    }

    public function __construct(string $url, ?callable $contextOptionsCallback = null)
    {
        $this->url = $url;

        $contextOptions = new ContextOptions;

        if ($contextOptionsCallback !== null) {
            $contextOptionsCallback($contextOptions);
        }

        $this->contextOptions = $contextOptions;
    }

    public function getContent(): string
    {
        $this->content === null && $this->loadContent();

        return $this->content;
    }

    private function loadContent(): void
    {
        $context = stream_context_create($this->contextOptions->toArray());

        $content = @file_get_contents($this->url, false, $context);

        if ($content === false) {
            throw new Exceptions\CoreException(error_get_last()['message']);
        }

        $this->content = $content;
    }
}
