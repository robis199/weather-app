<?php

namespace App\Service;

use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Cache\Adapter\DoctrineDbalAdapter;


class LocationServiceRequest
{

    private string $apiKey;
    private $client;
    private const BASE_URL = "http://api.ipstack.com/";

    private UserIpAddressService $ipAddressService;


    public function __construct(HttpClientInterface $client, UserIpAddressService $ipAddressService)
    {
        $this->client = $client;
        $this->apiKey = $_ENV['LOCATION_API_KEY'];
        $this->ipAddressService = $ipAddressService;
    }


    public function getCurrentLocation()
    {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $url = self::BASE_URL . $this->ipAddressService->getUserIpAddress() . "?access_key=$this->apiKey";

        return $cache
            ->get('city_' . $this->ipAddressService->getUserIpAddress(),
                function (ItemInterface $item) use ($url) {
                    $item->expiresAfter(3600);
                    return json_decode($this->client->request('GET', $url)->getContent(), true, 512, JSON_PRETTY_PRINT)['city'];
                });
    }

    public function refreshCurrentLocation()
    {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $cache->delete('city_' . $this->ipAddressService->getUserIpAddress());
    }
}
