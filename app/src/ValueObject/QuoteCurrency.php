<?php


namespace App\ValueObject;


class QuoteCurrency
{
    /**
     * @var float
     */
    private $rate;

    /**
     * @param  float $rate
     * @return self
     */
    public static function create(float $rate): self
    {
        $currency = (new self());
        $currency->rate = $rate;

        return $currency;
    }

    /**
     * @return string
     */
    public function rate(): string
    {
        return $this->rate;
    }
}