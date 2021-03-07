<?php


namespace App\Service\Currency;


use App\ValueObject\BaseCurrency;
use App\ValueObject\QuoteCurrency;

class ExchangerService
{
    /**
     * @param  BaseCurrency  $base
     * @param  QuoteCurrency $quote
     * @return float|int
     */
    public function exchangeRate(BaseCurrency $base, QuoteCurrency $quote): float|int
    {
        $exchangeRate = ($base->rate() * $base->amount()) / $quote->rate();

        return round($exchangeRate, 4);
    }
}