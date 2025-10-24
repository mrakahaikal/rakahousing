<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasCurrencyFormatter
{
    /**
     * List of columns that are considered currency.
     * Override in each model.
     * @var array<string>
     */
    protected array $currencyColumns = [];

    /**
     * Generate accessor for each currency column.
     *
     * @return array<string, \Illuminate\Database\Eloquent\Casts\Attribute>
     */
    public function currencyAccessors(): array
    {
        $accessors = [];

        foreach ($this->currencyColumns as $column) {
            $method = 'formatted' . ucfirst($column);

            $accessors[$method] = Attribute::get(
                fn() => $this->formatCurrency($this->{$column})
            );
        }

        return $accessors;
    }

    /**
     * Override default accessor resolver
     */
    public function __get($key)
    {
        $accessors = $this->currencyAccessors();

        if (isset($accessors[$key])) {
            return $accessors[$key]->get();
        }

        return parent::__get($key);
    }

    /**
     * Format number into currency string
     *
     * @param int|float $value
     * @param int $decimalPlace
     * @param string $decimalSeparator
     * @param string $thousandSeparator
     * @return string
     */
    protected function formatCurrency(int|float $value, int $decimalPlace = 2, string $decimalSeparator = ',', string $thousandSeparator=  '.'): string
    {
        return number_format((float)$value, $decimalPlace, $decimalSeparator, $thousandSeparator);
    }
}
