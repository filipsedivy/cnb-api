<?php declare(strict_types=1);

namespace CnbApi\Translator;

interface ITranslator
{
    public function __construct(string $data);

    public function toArray(): array;

    public function getData(): string;
}
