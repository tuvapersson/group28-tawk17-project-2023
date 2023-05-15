<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/UsersService.php";
require_once __DIR__ . "/../../business-logic/ActivitiesService.php";

// Class for handling requests to "home/User"

class UsersController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }



        // Path count is 2 meaning the current URL must be "/home/users"
        // Load start page for users
        if ($this->path_count == 2) {
            $this->showAll();
        }

        // Path count is 3 meaning the current URL must be "/home/users/{SOMETHING}"
        // if {SOMETHING} id "new" we want to show the form for creating a user
        else if ($this->path_count == 3 && $this->path_parts[2] == "new") {
            $this->showNewUserForm();
        }

        // Path count is 3 meaning the current URL must be "/home/users/{SOMETHING}"
        // {SOMETHING} is probably the user_id
        else if ($this->path_count == 3) {
            $this->showOne();
        }


        // Path count is 4 meaning the current URL must be "/home/users/{SOMETHING1}/{SOMETHING2}"
        // {SOMETHING1} is probably the user_id
        // if {SOMETHING2} is "edit" we will show the edit form
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->showEditForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }



    // Gets all users and shows them in the index view
    private function showAll()
    {
        $this->requireAuth();
        // $this->model is used for sending data to the view
        // $this->model = UsersService::getAllUsers();
        $this->model = UsersService::getAllUsersbyId($this->user->user_id);

        $this->viewPage("users/index");
    }



    // Gets one user and shows the in the single user-view
    private function showOne()
    {
        // Get the user with the ID from the URL
        $user = $this->getUser();
        $activity = ActivitiesService::getActivityByUserId($user->user_id);

        // // $this->model is used for sending data to the view
        // $this->model = $user;

        $this->model["user"] = $user;
        $this->model["activity"] = $activity;

        // Shows the view file users/single.php
        $this->viewPage("users/single");
    }



    // Gets one user and shows the in the edit user-view
    private function showEditForm()
    {
        // Get the user with the ID from the URL
        $user = $this->getUser();

        // $this->model is used for sending data to the view
        $this->model["user"] = $user;

        // Shows the view file users/edit.php
        $this->viewPage("users/edit");
    }



    // Gets one user and shows the in the edit user-view
    private function showNewUserForm()
    {
        // Shows the view file users/new.php
        $this->viewPage("users/new");
    }



    // Gets one user based on the id in the url
    private function getUser()
    {
        // Get the user with the specified ID
        $id = $this->path_parts[2];
        $user = UsersService::getUserById($id);
        $activity = ActivitiesService::getActivityByUserId($id);

        // Show not found if user doesn't exist
        if ($user == null) {
            $this->notFound();
        }

        return $user;
    }


    // handle all post requests for users in one place
    private function handlePost()
    {
        // Path count is 2 meaning the current URL must be "/home/users"
        // Create a user
        if ($this->path_count == 2) {
            $this->createUser();
        }

        // Path count is 4 meaning the current URL must be "/home/users/{SOMETHING1}/{SOMETHING2}"
        // {SOMETHING1} is probably the user_id
        // if {SOMETHING2} is "edit" we will update the user
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->updateUser();
        }

        // Path count is 4 meaning the current URL must be "/home/users/{SOMETHING1}/{SOMETHING2}"
        // {SOMETHING1} is probably the user_id
        // if {SOMETHING2} is "edit" we will show the edit form
        else if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deleteUser();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    // Create a user with data from the URL and body
    private function createUser()
    {
        $user = new UserModel();

        // Get updated properties from the body
        $user->user_name = $this->body["user_name"];
        $user->password_hash = $this->body["password"];
        $user->role = $this->body["role"];
        $user->pt_id = $this->body["pt_id"];

        // Save the user
        $success = UsersService::saveUser($user);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/users");
        } else {
            $this->error();
        }
    }


    // Update a user with data from the URL and body
    private function updateUser()
    {
        $user = new UserModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        // Get updated properties from the body
        $user->user_name = $this->body["user_name"];
        $user->password_hash = $this->body["password_hash"];
        $user->pt_id = $this->body["pt_id"];

        // Update the user
        $success = UsersService::updateUserById($id, $user);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/users");
        } else {
            $this->error();
        }
    }


    // Delete a user with data from the URL
    private function deleteUser()
    {

        // Get ID from the URL
        $id = $this->path_parts[2];

        // Delete the user
        $success = UsersService::deleteUserById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/users");
        } else {
            $this->error();
        }
    }
}
