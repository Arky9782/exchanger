<?php


namespace App\DTO;

class CurrencyPair
{
    /**
     * @var Currency
     */
    private $base;

    /**
     * @var Currency
     */
    private $quote;

    /**
     * @param Currency $base
     * @param Currency $quote
     * @return CurrencyPair
     */
    public static function create(
        Currency $base,
        Currency $quote
    ): CurrencyPair
    {
        return (new self())
            ->setBase($base)
            ->setQuote($quote);
    }

    /**
     * @return Currency
     */
    public function getBase(): Currency
    {
        return $this->base;
    }

    /**
     * @param  Currency $base
     * @return CurrencyPair
     */
    public function setBase(Currency $base): CurrencyPair
    {
        $this->base = $base;
        return $this;
    }

    /**
     * @return Currency
     */
    public function getQuote(): Currency
    {
        return $this->quote;
    }

    /**
     * @param  Currency $quote
     * @return CurrencyPair
     */
    public function setQuote(Currency $quote): CurrencyPair
    {
        $this->quote = $quote;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseIsoCode(): string
    {
        return $this->base->getIsoCode();
    }

    /**
     * @return float
     */
    public function getBaseAmount(): float
    {
        return $this->base->getAmount();
    }

    /**
     * @return string
     */
    public function getQuoteIsoCode(): string
    {
        return $this->quote->getIsoCode();
    }

    /**
     * @param  float $exchangeRate
     * @return $this
     */
    public function setExchangeRate(float $exchangeRate): self
    {
        $this->quote->setAmount($exchangeRate);

        return $this;
    }

    /**
     * @return float|null
     */
    public function getExchangeRate(): ?float
    {
        return $this->quote->getAmount();
    }
}