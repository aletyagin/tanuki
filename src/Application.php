<?php

namespace app;

use app\currency\Pair;
use app\exception\{
    MalformedResponseException,
    NetworkException,
    ObjectNotFoundException,
};
use app\interfaces\{
    ReceivingCourseService, StoringService,
};

class Application
{
    /**
     * @var ReceivingCourseService
     */
    private $receivingCourseService;

    /**
     * @var StoringService
     */
    private $storeService;

    /**
     * @param ReceivingCourseService $receivingCourseService
     * @param StoringService $storeService
     */
    public function __construct(ReceivingCourseService $receivingCourseService, StoringService $storeService)
    {
        $this->receivingCourseService = $receivingCourseService;
        $this->storeService = $storeService;
    }

    public function run(Pair ...$currencyPairs): void
    {
        foreach ($currencyPairs as $pair) {
            try {
                $this->storeService->store(
                    $this->receivingCourseService->receive($pair)
                );
            } catch (NetworkException | MalformedResponseException $e) {
                // Тут можно положить валютную пару в очередь для повторных попыток получить по ней курс.
            } catch (ObjectNotFoundException $e) {
                // Это странная ситуация, которая никогда не должна случиться.
                // Ведь перед получением курса я проверяю его наличие в хранилище.
                // Логируем.
            }
        }
    }
}