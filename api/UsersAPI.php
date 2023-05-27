<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/UsersService.php";

// Class for handling requests to "api/User"

class UsersAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {
        
        
        // If theres two parts in the path and the request method is GET 
        // it means that the client is requesting "api/Users" and
        // we should respond by returning a list of all users 
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getUsersById();
        } 

        // If there's three parts in the path and the request method is GET
        // it means that the client is requesting "api/Users/{something}".
        // In our API the last part ({something}) should contain the ID of a 
        // user and we should respond with the user of that ID
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // If theres two parts in the path and the request method is POST 
        // it means that the client is requesting "api/Users" and we
        // should get ths contents of the body and create a user.
        // else if ($this->path_count == 2 && $this->method == "POST") {
        //     $this->postOne();
        // }

        // If theres two parts in the path and the request method is PUT 
        // it means that the client is requesting "api/Users/{something}" and we
        // should get the contents of the body and update the user.
        // else if ($this->path_count == 3 && $this->method == "PUT") {
        //     $this->putOne($this->path_parts[2]);
        // } 

        // If theres two parts in the path and the request method is DELETE 
        // it means that the client is requesting "api/Users/{something}" and we
        // should get the ID from the URL and delete that user.
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        } 
        
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }

    // Gets all users and sends them to the client as JSON
    // private function getAll()
    // {
    //     $users = UsersService::getAllUsers();

    //     $this->sendJson($users);
    // }
    private function getUsersById()
    {
        $users = UsersService::getAllUsersbyId($this->user->user_id);

        $this->sendJson($users);
    }

    // Gets one and sends it to the client as JSON
    private function getById($id)
    {
        $user = UsersService::getUserById($id);

        if ($user) {
            $this->sendJson($user);
        }
        else {
            $this->notFound();
        }
    }

    // Deletes the user with the specified ID in the DB
    private function deleteOne($id)
    {
        $user = UsersService::getUserById($id);

        if($user == null){
            $this->notFound();
        }

        $success = UsersService::deleteUserById($id);

        if($success){
            $this->noContent();
        }
        else{
            $this->error();
        }
    }
}
