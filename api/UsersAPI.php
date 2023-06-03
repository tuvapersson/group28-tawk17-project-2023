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
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getUsersById();
        } 
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        } 
        
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }
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
