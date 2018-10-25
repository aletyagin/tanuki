<?php

namespace app\interfaces;

use app\currency\CurrencyCourse;
use app\currency\Pair;
use app\exception\{
    MalformedResponseException,
    NetworkException,
    ObjectNotFoundException,
};

interface ReceivingCourseService
{
    /**
     * @param Pair $currencyPair
     * @return CurrencyCourse
     * @throws ObjectNotFoundException | NetworkException | MalformedResponseException
     */
    public function receive(Pair $currencyPair): CurrencyCourse;
}