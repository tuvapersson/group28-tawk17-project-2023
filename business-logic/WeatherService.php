<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../weather-data-access/WeatherFetcher.php";

class WeatherService{

    public static function getCity($city){
        $weather_fetcher = new WeatherFetcher();

        $weather = $weather_fetcher->getCityWeather($city);

        // $temp = isset($city_data["temp"]) ? $city_data["temp"] : "";

        return $weather;
    }


}