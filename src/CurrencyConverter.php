<?php

namespace EdwardAlgorist\CurrencyConverter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CurrencyConverter
{

    /**
     * @var Client $client An instance of the Guzzle Client used to make API requests.
     */
    private Client $client;

    /**
     * @var int $ttl The time-to-live (TTL) value for the cache, in seconds.
     */
    private int $ttl;

    /**
     * Creates a new instance of the class.
     * @param int $ttl The time-to-live (TTL) value for the cache, in seconds. Defaults to 60 seconds.
     */
    public function __construct(int $ttl = 60)
    {
        $this->ttl = $ttl;
        $this->client = new Client(["base_uri" => "https://api.exchangerate.host"]);
    }

    /**
     * Retrieve the latest exchange rates from the API.
     * @param array $queries Additional query parameters to be included in the request.
     * @return object The response from the API in either object or array format.
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface|GuzzleException
     */
    public function rates(array $queries = []): object
    {
        return $this->get("/latest", $queries);
    }

    /**
     * Converts an amount from one currency to another.
     * @param string $from The currency to convert from.
     * @param string $to The currency to convert to.
     * @param float $amount The amount to convert. Defaults to 1.
     * @param array $queries Additional query parameters to be included in the request.
     * @return object
     * @throws ContainerExceptionInterface
     * @throws GuzzleException
     * @throws NotFoundExceptionInterface
     */
    public function convert(string $from, string $to, float $amount = 1, array $queries = []): object
    {
        return $this->get("/convert", compact("from", "to", "amount") + $queries);
    }

    /**
     * Retrieves historical exchange rate data for a given date.
     * @param string $date The date for which to retrieve data, in the format "YYYY-MM-DD".
     * @param array $queries Additional query parameters to be included in the request.
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface|GuzzleException
     */
    public function historical(string $date, array $queries = []): object
    {
        return $this->get("/${date}", $queries);
    }

    /**
     * Retrieves exchange rate data for a given date range.
     * @param string $start_date The start date for which to retrieve data, in the format "YYYY-MM-DD".
     * @param string $end_date The end date for which to retrieve data, in the format "YYYY-MM-DD".
     * @param array $queries Additional query parameters to be included in the request.
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface|GuzzleException
     */
    public function timeseries(string $start_date, string $end_date, array $queries = []): object
    {
        return $this->get("/timeseries", compact("start_date", "end_date") + $queries);
    }

    /**
     * Retrieves exchange rate fluctuation data for a given date range.
     * @param string $start_date The start date for which to retrieve data, in the format "YYYY-MM-DD".
     * @param string $end_date The end date for which to retrieve data, in the format "YYYY-MM-DD".
     * @param array $queries Additional query parameters to be included in the request.
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface|GuzzleException
     */
    public function fluctuation(string $start_date, string $end_date, array $queries = []): object
    {
        return $this->get("/fluctuation", compact("start_date", "end_date") + $queries);
    }

    /**
     * Retrieves a list of all available currency symbols.
     * @param array $queries Additional query parameters to be included in the request.
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface|GuzzleException
     */
    public function symbols(array $queries = []): object
    {
        return $this->get("/symbols", $queries);
    }

    /**
     * Retrieves a list of VAT (Value Added Tax) rates for different countries.
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface|GuzzleException
     */
    public function vatRates(array $queries = []): object
    {
        return $this->get("/vat_rates", $queries);
    }

    /**
     * Performs a GET request to the API and returns the response body.
     * @param string $path The API endpoint path.
     * @param array $queries Additional query parameters to be included in the request.
     * @return object The response body in JSON format, decoded as an object.
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface|GuzzleException
     */
    private function get(string $path, array $queries): object
    {

        $cacheKey = "exchangerates:" . sha1($path) . json_encode($queries);

        if (cache()->has($cacheKey))
            return cache()->get($cacheKey);

        $body = json_decode((string)$this->client->get($path, ["query" => $queries])->getBody());

        cache()->add($cacheKey, $body, $this->ttl);

        return $body;

    }

}