<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/UsersDatabase.php";

class UsersService{

    // Get one user by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getUserById($id){
        $users_database = new UsersDatabase();

        $user = $users_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $user;
    }
    public static function getAdmins() {
        $users_database = new UsersDatabase();

        $user = $users_database->getAllByRole();

        return $user;
    }

    public static function getUserByUsername($user_name)
    {
        $users_database = new UsersDatabase();

        $user = $users_database->getByUsername($user_name);

        return $user;
    }


    
    public static function getAllUsersbyId($id){
        $users_database = new UsersDatabase();

        $users = $users_database->getAllById($id);

        return $users;
    }

    // Delete the user from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deleteUserById($user_id){
        $users_database = new UsersDatabase();

        // If you need to validate data or control what 
        // gets deleted from the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $users_database->deleteById($user_id);

        return $success;
    }
}

