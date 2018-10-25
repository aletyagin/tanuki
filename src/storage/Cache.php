<?php

namespace app\storage;

use app\currency\CurrencyCourse;
use app\currency\Pair;
use app\exception\ObjectNotFoundException;
use app\interfaces\Storage;

class Cache implements Storage
{
    /**
     * @var CurrencyCourse[]
     */
    private $currencyCourses = [];

    public function hasCourseFor(Pair $pair): bool
    {
        return array_key_exists($pair->hash(), $this->currencyCourses);
    }

    public function findCourseFor(Pair $pair): CurrencyCourse
    {
        if ($this->hasCourseFor($pair)) {
            return $this->currencyCourses[$pair->hash()];
        }

        throw new ObjectNotFoundException();
    }

    public function saveCourse(CurrencyCourse $course): void
    {
        $this->currencyCourses[$course->currencyPair()->hash()] = $course;
    }
}