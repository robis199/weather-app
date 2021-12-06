<?php

namespace App\Service;

use App\Repository\ForecastRepository;

class ForecastService
{
    private ForecastRepository $repository;
    private LocationServiceRequest $currentLocation;


    public function __construct(LocationServiceRequest $currentLocation, ForecastRepository $repository)
    {
        $this->repository = $repository;
        $this->currentLocation = $currentLocation;
    }

    public function execute()
    {
        $location = $this->currentLocation->getCurrentLocation();
        return $this->repository->getCurrentForecast($location);
    }

}