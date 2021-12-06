<?php

namespace App\Repository;


interface ForecastRepository
{
    public function getCurrentForecast(string $currentLocation);
}