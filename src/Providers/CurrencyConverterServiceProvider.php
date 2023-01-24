<?php
namespace EdwardAlgorist\CurrencyConverter\Providers;
use EdwardAlgorist\CurrencyConverter\CurrencyConverter;
use Illuminate\Support\ServiceProvider;

class CurrencyConverterServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('currency-converter', function() {
            return new CurrencyConverter();
        });
    }

}