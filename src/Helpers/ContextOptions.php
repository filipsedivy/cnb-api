<?php declare(strict_types=1);

namespace CnbApi\Helpers;

class ContextOptions
{
    private $options = [];

    public function add(string $group, string $key, string $value): void
    {
        $this->options[$group][$key] = $value;
    }

    public function toArray(): array
    {
        return $this->options;
    }
}
