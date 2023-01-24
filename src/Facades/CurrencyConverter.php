<?php

namespace EdwardAlgorist\CurrencyConverter\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyConverter extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'currency-converter';
    }

}