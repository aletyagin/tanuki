<?php

namespace app\currency;

class CurrencyCourse
{
    /**
     * @var Pair
     */
    private $pair;

    /**
     * @var int
     */
    private $nominal;

    /**
     * @var double
     */
    private $value;

    /**
     * @param Pair $pair
     * @param int $nominal
     * @param float $value
     */
    public function __construct(Pair $pair, int $nominal, float $value)
    {
        $this->pair = $pair;
        $this->nominal = $nominal;
        $this->value = $value;
    }

    public function currencyPair(): Pair
    {
        return $this->pair;
    }

    public function has(Pair $pair): bool
    {
        return $pair->hash() == $this->pair->hash();
    }

    public function hash(): string
    {
        return md5($this->pair->hash());
    }
}