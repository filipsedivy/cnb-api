<?php

declare(strict_types=1);

namespace CnbApi\Source;

use DateTime;

interface ISource
{
    /**
     * @param DateTime $dateTime
     *
     * @return string
     */
    public function getByDate(DateTime $dateTime): string;
}