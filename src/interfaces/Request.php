<?php

namespace interfaces;

use app\http\HttpClient;

interface Request
{
    public function sendBy(HttpClient $client): array;
}