<?php


namespace App\Service\CBR;


use App\Interfaces\CurrencyRateSourceInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CurrencyRateExtractor implements CurrencyRateSourceInterface
{
    /**
     * @var string
     */
    private $xml;

    /**
     * CurrencyRateExtractor constructor.
     * @param CurrencyRatesApi $api
     * @param XmlCurrencyFinder $xmlCurrencyFinder
     */
    public function __construct(
        private CurrencyRatesApi $api,
        private XmlCurrencyFinder $xmlCurrencyFinder,
    ) {}

    /**
     * @param string $isoCode
     * @return float
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getCurrencyRate(
        string $isoCode
    ): float
    {
        if ($isoCode === 'RUB') {
            return 1.0000;
        }

        if (!$this->xml) {
            $this->xml = $this->api->getCurrenciesExchangeRates();
        }

        $currency = (array) $this->xmlCurrencyFinder->find($isoCode, $this->xml);

        $value = $this->convertValueToFloat($currency['Value']);
        $nominal = (int) $currency['Nominal'];

        return $value / $nominal;
    }

    /**
     * @param string $value
     * @return float
     */
    private function convertValueToFloat(string $value): float
    {
        return (float)(str_replace(',', '.', str_replace('.', '', $value)));
    }
}