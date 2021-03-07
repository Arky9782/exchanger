<?php


namespace App\ArgumentResolver;


use App\DTO\Currency;
use App\DTO\CurrencyPair;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CurrencyPairResolver implements ArgumentValueResolverInterface
{
    private const REQUIRED_PARAMS = [
        'base' => 'Base currency',
        'quote' => 'Quote currency',
        'amount' => 'Amount'
    ];

    /**
     * @param  Request          $request
     * @param  ArgumentMetadata $argument
     * @return iterable|void
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $data = $request->query->all();

        $this->validate($data);

        $base = Currency::create($data['base'], (float) $data['amount']);
        $quote = Currency::create($data['quote']);

        yield CurrencyPair::create($base, $quote);
    }

    /**
     * @param  Request          $request
     * @param  ArgumentMetadata $argument
     * @return bool
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === CurrencyPair::class;
    }

    /**
     * @param array $data
     */
    private function validate(array $data)
    {
        foreach (self::REQUIRED_PARAMS as $key => $name) {
            if (!isset($data[$key])) {
                throw new HttpException(
                    400,
                    sprintf('%s parameter is missing', $name)
                );
            }
        }
    }
}