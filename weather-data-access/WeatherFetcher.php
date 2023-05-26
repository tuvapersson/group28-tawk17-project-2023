<?php

class WeatherFetcher
{
    private $base_url = "https://api.weatherapi.com/v1/";

    public function getCityWeather($city)
    {
        $url = $this->base_url . "current.json?key=2822146e3a3e4db9ab9114356232605&q=/" . $city . "&aqi=no";
        // $url = "{$this->base_url}current.json?key=2822146e3a3e4db9ab9114356232605&q=/{$city}&aqi=no";

        $data = file_get_contents($url);
        $weather = json_decode($data, true);
        return $weather;
    
    }
}