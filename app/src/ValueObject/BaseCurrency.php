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
        return (new self())
            ->setRate($rate)
            ->setAmount($amount);
    }

    /**
     * @return string
     */
    public function rate(): string
    {
        return $this->rate;
    }

    /**
     * @param  float $rate
     * @return BaseCurrency
     */
    private function setRate(float $rate): BaseCurrency
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }

    /**
     * @param  float $amount
     * @return BaseCurrency
     */
    private function setAmount(float $amount): BaseCurrency
    {
        $this->amount = $amount;
        return $this;
    }
}