<?php

declare(strict_types=1);

namespace CnbApi\Source;

use CnbApi\DateTimeException;
use CnbApi\Helpers\Http;

class Cnb implements ISource
{
    const BASE_URL = 'https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/denni_kurz.txt';


    /**
     * @param \DateTime $dateTime
     *
     * @return string
     *
     * @throws DateTimeException
     */
    public function getByDate(\DateTime $dateTime): string
    {
        $url = $this->createUrl($dateTime);

        $http = new Http($url);

        return $http->getContent();
    }


    /**
     * @param \DateTime $dateTime
     *
     * @return string
     *
     * @throws DateTimeException
     */
    private function createUrl(\DateTime $dateTime): string
    {
        $dateValue = $dateTime->format('d.m.Y');

        return self::BASE_URL . '?date=' . $dateValue;
    }
}