<?php

namespace App\Casts;

use Money\Money;
use Money\Parser\IntlMoneyParser;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    protected $price;

    /**
     * Money constructor.
     * @param $price
     */

    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * Parses or formats money value.
     *
     * @param string $type Either 'parser' or 'formatter'.
     *
     * @return IntlMoneyFormatter|IntlMoneyParser|null
     */
    public static function getFormatterOrParser($type)
    {
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('nl_NL', \NumberFormatter::CURRENCY);

        if ($type === 'parser') {
            return new IntlMoneyParser($numberFormatter, $currencies);
        } else if ($type === 'formatter') {
            return new IntlMoneyFormatter($numberFormatter, $currencies);
        }

        return null;
    }

    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $money = Money::EUR($attributes['price']);
        $moneyFormatter = $this->getFormatterOrParser('formatter');

        return $moneyFormatter->format($money);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_int($value))
            return $value;

        $moneyParser = $this->getFormatterOrParser('parser');
        $money = $moneyParser->parse($value);

        return $money->getAmount();
    }
}
