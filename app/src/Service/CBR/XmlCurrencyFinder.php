<?php


namespace App\Service\CBR;


use App\Service\XML\SimpleXmlLoader;
use RuntimeException;
use SimpleXMLElement;

class XmlCurrencyFinder
{
    /**
     * XmlCurrencyFinder constructor.
     * @param SimpleXmlLoader $simpleXmlLoader
     */
    public function __construct(private SimpleXmlLoader $simpleXmlLoader)
    {
    }

    /**
     * @param  string $isoCode
     * @param  string $xml
     * @return SimpleXMLElement
     */
    public function find(string $isoCode, string $xml): SimpleXMLElement
    {
        $currenciesXml = $this
            ->simpleXmlLoader
            ->loadFromString($xml);

        $xpathNamespace = sprintf('//Valute[CharCode=\'%s\']', $isoCode);

        $result = $currenciesXml->xpath($xpathNamespace);

        if (!isset($result[0])) {
            throw new RuntimeException(
                sprintf(
                    "Currency with ISO code \"%s\" was not found in given XML",
                    $isoCode
                )
            );
        }

        return $result[0];
    }


}