<?php

namespace app\interfaces;

use app\currency\{Pair, CurrencyCourse};
use app\exception\ObjectNotFoundException;

interface Storage
{
    public function hasCourseFor(Pair $pair): bool;

    /**
     * @param Pair $pair
     * @return CurrencyCourse
     * @throws ObjectNotFoundException
     */
    public function findCourseFor(Pair $pair): CurrencyCourse;

    public function saveCourse(CurrencyCourse $course): void;
}