<?php

use app\Application;
use app\RegularReceivingCourse;
use app\StoreService;
use app\externalSource\Http;
use app\storage\{Cache, Database};
use app\currency\{Pair, Currency};
use app\http\HttpClient;

require 'vendor/autoload.php';

$app =
    new Application(
        new RegularReceivingCourse(
            new Http(new HttpClient()),
            new Cache(),
            new Database()
        ),
        new StoreService(
            new Cache(),
            new Database()
        )
    );

$app->run(
    new Pair(
        new Currency('USD'),
        new Currency('RUB')
    )
);
