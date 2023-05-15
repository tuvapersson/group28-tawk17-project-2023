<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Load functions file
require_once __DIR__ . "/functions.php";

// Load controllers
require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/UserController.php";
require_once __DIR__ . "/controllers/HomeController.php";
require_once __DIR__ . "/controllers/AssetsController.php";

// Class for routing all our API requests

class FrontendRouter
{

    private $path_parts, $query_params, $path_count;
    private $routes = [];

    public function __construct($path_parts, $query_params)
    {

        // Available routes
        // Add to this if you need to add any route to the API
        $this->routes = [
            // Whenever someone calls "home/users" we 
            // will load the CustomerPages class
            "home" => "HomeController",
            "auth" => "AuthController",
            "users" => "UsersController",
            "assets" => "AssetsController",
        ];

        $this->path_parts = $path_parts;
        $this->query_params = $query_params;
        $this->path_count = count($this->path_parts);

    }

    public function handleRequest()
    {

        // Load home page if no resource is specified
        // (the "resource" is the second part of the URL path)
        // ( {BASE_URL}/home/{RESOURCE} )
        $resource = "home";
        $route_class = $this->routes[$resource];
        $request_info = [];

        if ($this->path_count >= 2 && $this->path_parts[1] != "") {
            // Get the requested resource from the URL such as "users" or "Products"
            $resource = strtolower($this->path_parts[1]);
        }

        // Check if route from URL exists
        if (isset($this->routes[$resource])) {
            // Get the class specified in the routes
            $route_class = $this->routes[$resource];
        } else {
            $request_info = "not_found";
        }

        // Create a new object from the resource class
        $route_object = new $route_class($this->path_parts, $this->query_params);

        // Handle the request
        $route_object->handleRequest($request_info);
    }
}
