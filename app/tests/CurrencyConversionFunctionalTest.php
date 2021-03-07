<?php

namespace App\Tests;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsJson;
use PHPUnit\Framework\Constraint\IsType;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CurrencyConversionFunctionalTest extends WebTestCase
{
    public function testSomething(): void
    {
        $base = 'GBP';
        $quote = 'RUB';
        $client = static::createClient();
        $client->request(
            method: 'GET',
            uri: "/currency/convert?base=$base&quote=$quote&amount=101",
            server: ['CONTENT_TYPE' => 'application/json'],
        );

        $response = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();

        $this->assertThat($response, new IsJson());

        $data = json_decode($response, true);

        $value = $data["$base/$quote"];

        $this->assertThat($value, (new IsType("float")));
    }
}
