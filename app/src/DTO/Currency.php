<?php


namespace App\DTO;


class Currency
{
    /**
     * @var string
     */
    private $isoCode;

    /**
     * @var float|null
     */
    private $amount;

    /**
     * @param  string      $isoCode
     * @param  string|null $amount
     * @return static
     */
    public static function create(
        string $isoCode,
        string $amount = null
    ) :self {
        return (new self())
            ->setIsoCode($isoCode)
            ->setAmount($amount);
    }

    /**
     * @return string
     */
    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    /**
     * @param string $isoCode
     */
    public function setIsoCode(string $isoCode): self
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }


    /**
     * @param  float|null $amount
     * @return $this
     */
    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}