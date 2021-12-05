<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{

    private $client;

    private $location;

    public function __construct(HttpClientInterface $client, LocationService $location)
    {
        $this->client = $client;
        $this->location = $location;
    }


    public function getCurrentForecast(): array
    {

        $apiKey = $_ENV['WEATHER_API_KEY'];
        $currentLocation = ($this->location->getCurrentLocation()->getContent());

        $response = $this->client->request(
            'GET',
            "https://api.openweathermap.org/data/2.5/weather?q=$currentLocation&units=metric&appid=$apiKey"
        );


        return $response->toArray();

    }
}
