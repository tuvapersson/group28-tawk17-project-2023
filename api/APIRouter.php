<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/UsersAPI.php";
require_once __DIR__ . "/WeatherAPI.php";
require_once __DIR__ . "/ActivitiesAPI.php";
require_once __DIR__ . "/AuthAPI.php";
require_once __DIR__ . "/APIRoot.php";

// Class for routing all our API requests

class APIRouter
{

    private $path_parts, $query_params;
    private $routes = [];

    public function __construct($path_parts, $query_params)
    {
        $this->routes = [
            "auth" => "AuthAPI",
            "users" => "UsersAPI",
            "activities" => "ActivitiesAPI",
            "weather" => "WeatherAPI",
            "root" => "APIRoot"
        ];

        $this->path_parts = $path_parts;
        $this->query_params = $query_params;
    }

    public function handleRequest()
    {

        $resource = "root";
        $route_class = $this->routes[$resource];

        if (count($this->path_parts) >= 2 && $this->path_parts[1] != "") {
            $resource = strtolower($this->path_parts[1]);
        }

        if (isset($this->routes[$resource])) {
            $route_class = $this->routes[$resource];
        }

        $route_object = new $route_class($this->path_parts, $this->query_params);

        // Handle the request
        $route_object->handleRequest();
    }
}
