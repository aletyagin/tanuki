<?php

namespace app\currency;

class Currency
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function equals(Currency $currency): bool
    {
        return $currency->hasId($this->id);
    }

    public function hasId(string $id): bool
    {
        return $this->id == $id;
    }

    public function hash(): string
    {
        return md5($this->id);
    }

    public function id(): string
    {
        return $this->id;
    }
}