<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = $_ENV['API_KEY'];
    }

    public function getWeatherByCity($city)
    {
        $response = $this->client->get('https://api.openweathermap.org/data/2.5/weather', [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'pt_br'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getWeatherForecast($city)
    {
        $response = $this->client->get('https://api.openweathermap.org/data/2.5/weather', [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'pt_br'
            ]
        ]);

        $currentWeather = json_decode($response->getBody()->getContents(), true);

        $lat = $currentWeather['coord']['lat'];
        $lon = $currentWeather['coord']['lon'];

        $forecastResponse = $this->client->get('https://api.openweathermap.org/data/2.5/forecast', [
            'query' => [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'pt_br'
            ]
        ]);

        $forecastData = json_decode($forecastResponse->getBody()->getContents(), true);

        return [
            'current' => $currentWeather,
            'forecast' => $forecastData
        ];
    }


}
