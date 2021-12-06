<?php
namespace App\Service;

use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class WeatherService
{

    private $client;

    private $location;

    public function __construct(ClientInterface $client, LocationService $location)
    {
        $this->client = $client;
        $this->location = $location;
    }


    public function getCurrentForecast(): ResponseInterface
    {

        $apiKey = $_ENV['WEATHER_API_KEY'];

        $currentLocation = $this->location->getCurrentLocation();

        $request = $this->client->createRequest(
            'GET',
            "https://api.openweathermap.org/data/2.5/weather?q=".$currentLocation."&lang=la&units=metric&appid=".$apiKey
        );

        return $this->client->sendRequest($request);

    }
}
