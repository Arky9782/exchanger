<?php


namespace App\Interfaces;


interface CurrencyRateSourceInterface
{
    /**
     * @param string $isoCode
     * @return float
     */
    public function getCurrencyRate(string $isoCode): float;
}