<?php declare(strict_types=1);

namespace Tests\Engine\Source;

use CnbApi;
use CnbApi\Translator;
use DateTimeInterface;

class FileSource implements CnbApi\Source\ISource
{
    public function getByDate(DateTimeInterface $dateTime): string
    {
        $path = sprintf('%s/denni_kurz_%s.txt', $this->getBaseUrl(), $dateTime->format('Y_m_d'));

        if (!file_exists($path)) {
            throw new CnbApi\Exceptions\IOException('Path not found (' . $path . ')');
        }

        return file_get_contents($path);
    }

    public function getBaseUrl(): string
    {
        return DATA_DIR;
    }

    public function getTranslator(): string
    {
        return Translator\CnbTranslator::class;
    }
}
