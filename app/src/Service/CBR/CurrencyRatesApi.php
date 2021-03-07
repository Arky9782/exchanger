<?php


namespace App\Service\CBR;


use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyRatesApi
{
    private const EXCHANGE_SOURCE_URL = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * CurrencyRatesApi constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(private HttpClientInterface $client)
    {
    }

    /**
     * @return string
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getCurrenciesExchangeRates(): string
    {
        $response = $this
            ->client
            ->request('GET', self::EXCHANGE_SOURCE_URL);

        return $response->getContent();
    }
}