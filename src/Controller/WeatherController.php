<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{


    public function index(): RedirectResponse
    {

    }

    public function getForecast(): Response
    {



        return $this->json([]);
    }
}

//return createNotFoundException()
