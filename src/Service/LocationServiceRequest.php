<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Cache\Adapter\DoctrineDbalAdapter;


class LocationServiceRequest
{

    private $apiKey;
    private $client;
    private $ipAddress;
    private const BASE_URL = "http://api.ipstack.com/";


    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->apiKey = $_ENV['LOCATION_API_KEY'];
        $this->ipAddress = '212.3.196.56';
    }


    public function getUserIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getCurrentLocation()
    {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $url = self::BASE_URL . $this->getUserIpAddress() . "?access_key=$this->apiKey";

        return $cache
            ->get('city_' . $this->getUserIpAddress(),
                function () use ($url) {
                    return json_decode($this->client->request('GET', $url)->getContent(), true, 512, JSON_PRETTY_PRINT)['city'];
                });
    }

    public function refreshLocation()
    {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $userIp = $this->getUserIpAddress();
        $cache->delete('city_' . $userIp);
    }
}
