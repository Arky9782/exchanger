<?php

namespace App\Controller;

use App\DTO\CurrencyPair;
use App\Handler\ConversionHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    /**
     * @Route(
     *     "/currency/convert",
     *     name="currency_convert",
     *     methods={"GET"}
     *     )
     *
     * @param ConversionHandler $handler
     * @param CurrencyPair $currencyPair
     * @return Response
     */
    public function convert(
        ConversionHandler $handler,
        CurrencyPair $currencyPair
    ): Response {
        $currencyPair = $handler->handle($currencyPair);
        $pair = sprintf(
            '%s/%s',
            $currencyPair->getBaseIsoCode(),
            $currencyPair->getQuoteIsoCode()
        );

        return $this->json(
            [
                $pair => $currencyPair->getExchangeRate()
            ]
        );
    }
}
