<?php


namespace App\ValueObject;


class BaseCurrency
{
    /**
     * @var float
     */
    private $rate;

    /**
     * @var float
     */
    private $amount;

    /**
     * @param  float $rate
     * @param  float $amount
     * @return BaseCurrency
     */
    public static function create(float $rate, float $amount): BaseCurrency
    {
        $currency =  (new self());
        $currency->rate = $rate;
        $currency->amount = $amount;

        return $currency;
    }

    /**
     * @return string
     */
    public function rate(): string
    {
        return $this->rate;
    }
    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }
}