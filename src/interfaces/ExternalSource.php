<?php

namespace app\interfaces;

use app\currency\{Pair, CurrencyCourse};
use app\exception\MalformedResponseException;
use app\exception\NetworkException;

interface ExternalSource
{
    /**
     * @param Pair $pair
     * @return CurrencyCourse
     * @throws NetworkException
     * @throws MalformedResponseException
     */
    public function getCourseFor(Pair $pair): CurrencyCourse;
}