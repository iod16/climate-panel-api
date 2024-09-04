<?php

namespace App\Controllers;

use App\Services\WeatherService;
use App\Helpers\ResponseHelper;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather($city)
    {
        if (empty($city)) {
            return ResponseHelper::json(['error' => 'City is required'], 400);
        }

        try {
            $weatherData = $this->weatherService->getWeatherForecast($city);

            return ResponseHelper::json($weatherData);
        } catch (\Exception $e) {
            return ResponseHelper::json(['error' => 'Failed to fetch weather data', 'message' => $e->getMessage()], 500);
        }
    }
}
