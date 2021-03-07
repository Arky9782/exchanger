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
        return (new self())
            ->setRate($rate);
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
     * @return self
     */
    private function setRate(float $rate): self
    {
        $this->rate = $rate;
        return $this;
    }
}