<?php

namespace app;

use app\currency\{Pair, CurrencyCourse};
use app\interfaces\{
    ReceivingCourseService, Storage, ExternalSource,
};

class RegularReceivingCourse implements ReceivingCourseService
{
    /**
     * @var Storage[]
     */
    private $storages;

    /**
     * @var ExternalSource
     */
    private $http;

    /**
     * @param ExternalSource $http
     * @param Storage[] $storages
     */
    public function __construct(ExternalSource $http, Storage ...$storages)
    {
        $this->storages = $storages;
        $this->http = $http;
    }

    /*
     * Я позволил себе отойти от задания и сначала получить курс не важно из какого источника,
     * а затем в другом сервисе сохранить его везде, где он не сохранен.
     * Так, получается, что каждый сервис занимается только своей задачей.
     * А может мы где-то не захотим при получении курса сохранять его в хранилище.
     */
    public function receive(Pair $currencyPair): CurrencyCourse
    {
        foreach ($this->storages as $storage) {
            if ($storage->hasCourseFor($currencyPair)) {
                return $storage->findCourseFor($currencyPair);
            }
        }

        return $this->http->getCourseFor($currencyPair);
    }
}