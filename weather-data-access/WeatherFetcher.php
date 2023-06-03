<?php

class WeatherFetcher
{
    private $base_url = "https://api.weatherapi.com/v1/";

    public function getCityWeather($city)
    {
        $url = $this->base_url . "current.json?key=" . WEATHER_API_KEY . "&q=/" . $city . "&aqi=no";

        $data = file_get_contents($url);
        $weather = json_decode($data, true);
        return $weather;
    
    }
}