<?php

namespace app\externalSource;

use app\http\HttpClient;
use interfaces\Request;

class GetCourseRequest implements Request
{
    /**
     * @var string
     */
    private $fromId;

    /**
     * @var string
     */
    private $toId;

    /**
     * GetCourseRequest constructor.
     * @param string $fromId
     * @param string $toId
     */
    public function __construct(string $fromId, string $toId)
    {
        $this->fromId = $fromId;
        $this->toId = $toId;
    }

    public function sendBy(HttpClient $client): array
    {
        return
            $client->sendGetRequest([
                'from' => $this->fromId,
                'to' => $this->toId,
            ]);
    }
}