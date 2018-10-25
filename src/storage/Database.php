<?php

namespace app\storage;

use app\currency\Pair;
use app\currency\CurrencyCourse;
use app\exception\ObjectNotFoundException;
use app\interfaces\Storage;

class Database implements Storage
{
    /**
     * @var CurrencyCourse[]
     */
    private $currencyCourses = [];

    public function hasCourseFor(Pair $pair): bool
    {
        foreach ($this->currencyCourses as $course) {
            if ($course->has($pair)) {
                return true;
            }
        }

        return false;
    }

    public function findCourseFor(Pair $pair): CurrencyCourse
    {
        // assert()

        foreach ($this->currencyCourses as $course) {
            if ($course->has($pair)) {
                return $course;
            }
        }

        throw new ObjectNotFoundException();
    }

    public function saveCourse(CurrencyCourse $course): void
    {
        $this->currencyCourses[] = $course;
    }
}