<?php

namespace app\currency;

use app\externalSource\GetCourseRequest;
use interfaces\Request;

class Pair
{
    /**
     * @var Currency
     */
    private $from;

    /**
     * @var Currency
     */
    private $to;

    /**
     * @param Currency $from
     * @param Currency $to
     */
    public function __construct(Currency $from, Currency $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function hash(): string
    {
        return md5($this->from->hash() . $this->to->hash());
    }

    /*
     * Если наша область подразумевает получение курсов по валютной паре, в том числе из внешнего источника,
     * то мы можем себе позволить поместить знание какой реквест создавать в эту самую валютную пару.
     */
    public function buildRequest(): Request
    {
        return new GetCourseRequest($this->from->id(), $this->to->id());
    }
}