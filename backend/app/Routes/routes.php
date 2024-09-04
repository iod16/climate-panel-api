<?php

use App\Controllers\WeatherController;
use App\Services\WeatherService;

$router->map('GET', '/weather', function() {
    $city = $_GET['city'] ?? '';
    $weatherController = new WeatherController(new WeatherService());

    return $weatherController->getWeather($city);
});