<?php

namespace app\externalSource;

use app\currency\{Pair, CurrencyCourse};
use app\http\HttpClient;
use app\interfaces\ExternalSource;

class Http implements ExternalSource
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function getCourseFor(Pair $pair): CurrencyCourse
    {
        $data = $pair->buildRequest()->sendBy($this->client);

        return new CurrencyCourse($pair, $data['nominal'], $data['value']);
    }
}