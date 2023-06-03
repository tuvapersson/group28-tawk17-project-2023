<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/UsersDatabase.php";

class UsersService{

    public static function getUserById($id){

        $users_database = new UsersDatabase();

        $user = $users_database->getOne($id);

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

    public static function deleteUserById($user_id){

        $users_database = new UsersDatabase();

        $success = $users_database->deleteById($user_id);

        return $success;
    }
}

