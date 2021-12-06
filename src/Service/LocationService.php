<?php
namespace App\Service;


use http\Client\Response;
use Psr\Cache\InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\Cache\Adapter\DoctrineDbalAdapter;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;


class LocationService
{

    private $client;




    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }


    public function getUserIpAddress(): string
    {
        return '212.3.196.56';
    }

    public function getCurrentLocation(): Response
    {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);

        $userIp = $this->getUserIpAddress();

        $cache->get('city_'.$userIp, function () use ($userIp) {
            $apiKey = $_ENV['LOCATION_API_KEY'];

            $request = $this->client->createRequest(
                'GET',
                "http://api.ipstack.com/$userIp?access_key=$apiKey"
            );
            $response = $this->client->sendRequest($request);

            return $response->getBody()->getContents();
        });


    }

    /**
     * @throws InvalidArgumentException
     */
    public function refreshLocation() {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $userIp = $this->getUserIpAddress();
        $cache->delete('city_'.$userIp);
    }
}
