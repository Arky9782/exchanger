<?php


namespace App\Handler;


use App\DTO\CurrencyPair;
use App\Interfaces\CurrencyRateSourceInterface;
use App\Service\Currency\ExchangerService;
use App\ValueObject\BaseCurrency;
use App\ValueObject\QuoteCurrency;

class ConversionHandler
{

    /**
     * ConversionHandler constructor.
     * @param CurrencyRateSourceInterface $exchangeRateSource
     * @param ExchangerService $exchangerService
     */
    public function __construct(
        private CurrencyRateSourceInterface $exchangeRateSource,
        private ExchangerService $exchangerService
    ) {}

    /**
     * @param CurrencyPair $currencyPair
     * @return CurrencyPair
     */
    public function handle(CurrencyPair $currencyPair): CurrencyPair
    {
        $baseRate = $this
            ->exchangeRateSource
            ->getCurrencyRate($currencyPair->getBaseIsoCode());

        $quoteRate = $this
            ->exchangeRateSource
            ->getCurrencyRate($currencyPair->getQuoteIsoCode());

        $base = BaseCurrency::create($baseRate, $currencyPair->getBaseAmount());
        $quote = QuoteCurrency::create($quoteRate);

        $exchangeRate = $this->exchangerService->exchangeRate($base, $quote);

        $currencyPair->setExchangeRate($exchangeRate);

        return $currencyPair;
    }
}