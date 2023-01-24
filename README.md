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

## Retrieving Currency Symbols
You can retrieve a list of all available currency symbols by calling the `symbols()` method on your `CurrencyConverter` instance.

```php
$symbols = $converter->symbols();
```

## Retrieving VAT Rates
You can retrieve a list of VAT (Value Added Tax) rates for different countries by calling the `vatRates()` method on your `CurrencyConverter` instance.

```php
$vatRates = $converter->vatRates();
```

## Exception Handling

The package throws several exceptions in the event of an error. These include:

- `NotFoundExceptionInterface`: thrown when a requested resource cannot be found.
- `ContainerExceptionInterface`: thrown when an error occurs in the container.
- `GuzzleException`: thrown when an error occurs while making an API request.

It is recommended to wrap your code in a try-catch block to handle any exceptions that may be thrown.

## Additional Features

- The package supports caching of API responses for faster performance.
- It also supports additional query parameters to be passed to the API.
- The package uses GuzzleHttp to make API requests, which means it has support for all features provided by Guzzle.

## Conclusion

The CurrencyConverter package makes it easy to convert currencies using the exchangerate.host API. It has a simple and easy-to-use interface, and supports caching of API responses for faster performance. The package is well documented and easy to use, making it a great choice for any project that needs to convert currencies.

Contributing
Thank you for considering contributing to CurrencyConverter package! We welcome any contributions, bug reports, suggestions, and feedback.

License
The CurrencyConverter package is open-sourced software licensed under the [MIT](https://github.com/edwardalgorist/currency-converter/blob/master/LICENSE.md) license.
