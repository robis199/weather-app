<?php

namespace App\Controller;

use App\Service\ForecastService;
use App\Service\LocationServiceRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    private ForecastService $forecastService;
    private LocationServiceRequest $locationService;

    public function __construct(ForecastService $forecastService, LocationServiceRequest $locationService)
    {
        $this->forecastService = $forecastService;
        $this->locationService = $locationService;
    }

    public function getForecast(): Response
    {
        return $this->render('base.html.twig', ['forecast' => $this->forecastService->execute()]);
    }

    public function refresh(): RedirectResponse
    {
        $this->locationService->refreshLocation();
        return $this->redirect('/');
    }
}

//return createNotFoundException()
