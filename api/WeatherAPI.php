<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/WeatherService.php";

// Class for handling requests to "api/User"

class WeatherAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {
        
        // If theres two parts in the path and the request method is GET 
        // it means that the client is requesting "api/weather" 
        if ($this->method == "GET" && $this->path_count == 2) {
            $city = isset($_GET["city"]) ? $_GET["city"] : null;


            if($city){
                // Get city
                $weather_response = WeatherService::getCity($city);
                $this->sendJson($weather_response);

            }
        } 

        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }
   
}
