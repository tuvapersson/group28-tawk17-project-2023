<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/AuthService.php";

// Class for handling requests to "home/Auth"

class AuthController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }



        // GET: /home/auth/login
        if ($this->path_count == 3 && $this->path_parts[2] == "login") {
            $this->showLoginForm();
        }

        // GET: /home/auth/register
        if ($this->path_count == 3 && $this->path_parts[2] == "register") {
            $this->showRegisterForm();
        }

        // GET: /home/auth/profile
        if ($this->path_count == 3 && $this->path_parts[2] == "profile") {
            $this->showProfilePage();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }



    private function showLoginForm()
    {
        // Shows the view file auth/login.php
        $this->viewPage("auth/login");
    }

    private function showRegisterForm()
    {
        //skicka med att pt's.
        $this->model["available_admins"] = UsersService::getAdmins();
        // Shows the view file auth/register.php
        $this->viewPage("auth/register");
    }

    private function showProfilePage()
    {
        if ($this->user->pt_id !== null) {
        $user = UsersService::getUserById($this->user->pt_id);
        $this->model["user"] = $user;

        $this->model["user"] = $user;
        }
        // Shows the view file auth/register.php
        
        $this->viewPage("auth/profile");
    }


    // handle all post requests in one place
    private function handlePost()
    {
        // POST: /home/auth/login
        if ($this->path_count == 3 && $this->path_parts[2] == "login") {
            $this->loginUser();
        }

        // POST: /home/auth/register
        else if ($this->path_count == 3 && $this->path_parts[2] == "register") {
            $this->registerUser();
        }

        // POST: /home/auth/logout
        else if ($this->path_count == 3 && $this->path_parts[2] == "logout") {
            $this->logoutUser();
        }
        else {
            $this->notFound();
        }
    }


    private function loginUser()
    {
        $user_name = $this->body["user_name"];
        $test_password = $this->body["password"];

        $user = AuthService::authenticateUser($user_name, $test_password);

        if ($user === false) {
            $this->model["error"] = "Invalid credentials";
            $this->viewPage("auth/login");
        }

        $_SESSION["user"] = $user;

        $this->redirect($this->home . "/");
    }


    private function registerUser()
    {
        $user = new UserModel();

        $user->user_name = $this->body["user_name"];
        $password = $this->body["password"];
        $confirm_password = $this->body["confirm_password"];
        $user->role = $this->body["role"];
        

        if (isset($this->body["pt_id"])) {
            $user->pt_id = $this->body["pt_id"];
        }
        if ($password !== $confirm_password) {
            $this->model["error"] == "Passwords don't match";
            $this->viewPage("auth/register");
        }

        $existing_user = UsersService::getUserByUsername($user->user_name);

        if ($existing_user) {
            $this->model["error"] == "Username already in use";
            $this->viewPage("auth/register");
        }

        $success = AuthService::registerUser($user, $password);

        if ($success) {
            $this->redirect($this->home . "/auth/login");
        } else {
            $this->model["error"] == "Error registering user";
            $this->viewPage("auth/register");
        }
    }


    private function logoutUser()
    {
        session_destroy();

        $this->redirect($this->home . "/auth/login");
    }

}