# Currency Converter

A simple and easy-to-use package for converting currencies using the [exchangerate.host](https://www.exchangerate.host) API. The package supports conversion, historical rates, time series data retrieval and exchange rate fluctuation data retrieval. It also supports caching of API responses for faster performance.

## Installation
To install the package, run the following command in your project's root directory:

```php
composer require edwardalgorist/currency-converter
```

## Usage
To use the package, you will first need to create an instance of the `CurrencyConverter` class. You can do this by including the namespace and instantiating the class with the `new` keyword:

```php
use EdwardAlgorist\CurrencyConverter\CurrencyConverter;

$converter = new CurrencyConverter();
```

You can also pass a time-to-live (TTL) value for the cache in seconds, which defaults to 60 seconds.

## Retrieving Exchange Rates
You can retrieve the latest exchange rates by calling the `rates()` method on your `CurrencyConverter` instance. This method returns an object with the rates in either object or array format.

```php
$rates = $converter->rates();
```

You can also pass an array of additional query parameters to the `rates()` method.

## Currency Conversion
You can convert an amount from one currency to another by calling the `convert()` method on your `CurrencyConverter` instance. The method takes three arguments: the currency to convert from, the currency to convert to, and the amount to convert. It returns an object with the result.

```php
$converted = $converter->convert("USD", "EUR", 100);
```

## Retrieving Historical Rates

You can retrieve historical exchange rate data for a given date by calling the `historical()` method on your `CurrencyConverter` instance. The method takes a date argument in the format "YYYY-MM-DD".

```php
$historical = $converter->historical("2022-01-01");
```

## Retrieving Time Series Data

You can retrieve exchange rate data for a given date range by calling the `timeseries()` method on your `CurrencyConverter` instance. The method takes two date arguments in the format "YYYY-MM-DD".

```php
$timeseries = $converter->timeseries("2022-01-01", "2022-01-31");
```

## Retrieving Fluctuation Data

You can retrieve exchange rate fluctuation data for a given date range by calling the `fluctuation()` method on your `CurrencyConverter` instance. The method takes two date arguments in the format "YYYY-MM-DD".

```php
$fluctuation = $converter->fluctuation("2022-01-01", "2022-01-31");
```
