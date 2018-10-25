<?php

namespace app\interfaces;

use app\currency\CurrencyCourse;

interface StoringService
{
    public function store(CurrencyCourse $course);
}