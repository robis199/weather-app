<?php

namespace App\Repository;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenWeatherApiRepository implements ForecastRepository
{
    private string $apiKey;

    private $client;

    private const BASE_URL = 'https://api.openweathermap.org/data/2.5/weather?q=';


    public function __construct(HttpClientInterface $client)
    {
        $this->apiKey = $_ENV['WEATHER_API_KEY'];
        $this->client = $client;
    }

    public function getCurrentForecast(string $currentLocation)
    {
        $url = self::BASE_URL . $currentLocation . "&units=metric&appid=$this->apiKey";

        return json_encode($this->client->request(
            'GET',
            $url)->getContent(), JSON_PRETTY_PRINT);

    }
}
