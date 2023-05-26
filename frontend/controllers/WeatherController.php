<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/WeatherService.php";


class WeatherController extends ControllerBase
{

    public function handleRequest()
    {
        $city = isset($this->query_params["city"]) ? $this->query_params["city"] : null;

        $this->model = "";

        if($city){
            // Get city
            $this->model = []; // Initialize $this->model as an empty array
            $this->model["weather"] = WeatherService::getCity($city);

        }

        $this->viewPage("weather/home");
    }
}