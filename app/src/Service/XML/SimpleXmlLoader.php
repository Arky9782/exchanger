<?php


namespace App\Service\XML;


use RuntimeException;
use SimpleXMLElement;

class SimpleXmlLoader
{
    /**
     * @param  string $xml
     * @return SimpleXMLElement
     */
    public function loadFromString(string $xml): SimpleXMLElement
    {
        $xml = simplexml_load_string($xml);

        if (!$xml) {
            throw new RuntimeException("Invalid XML String");
        }

        return $xml;
    }
}