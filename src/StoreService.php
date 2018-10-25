<?php

namespace app;

use app\currency\CurrencyCourse;
use app\interfaces\StoringService;
use app\interfaces\Storage;

class StoreService implements StoringService
{
    /**
     * @var Storage[]
     */
    private $storages;

    /**
     * @param Storage[] $storages
     */
    public function __construct(Storage ...$storages)
    {
        $this->storages = $storages;
    }

    public function store(CurrencyCourse $course)
    {
        foreach ($this->storages as $storage) {
            if (!$storage->hasCourseFor($course->currencyPair())) {
                $storage->saveCourse($course);
            }
        }
    }
}