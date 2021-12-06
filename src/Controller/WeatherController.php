<?php

namespace App\Controller;

use App\Service\LocationService;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{

    private WeatherService $weatherForecast;
    private LocationService $location;

    public function __construct(WeatherService $weatherForecast, LocationService $location)
    {
        $this->weatherForecast = $weatherForecast;
        $this->location = $location;
    }

    public function getForecast(): Response
    {
        return $this->render('base.html.twig', ['forecast' => $this->weatherForecast->getCurrentForecast()]);
    }

    public function refresh()
    {
        $this->location->refreshLocation();
        return $this->redirect('/');
    }
}

//return createNotFoundException()
