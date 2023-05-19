<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/UserModel.php";

class UsersDatabase extends Database
{
    private $table_name = "users";
    private $id_name = "user_id";

    // Get one user by using the inherited function getOneRowByIdFromTable
    // Never send the password hash unless needed for authentication
    public function getByUsername($user_name)
    {
        $user = $this->getByUsernameWithPassword($user_name);

        // Never send the password hash unless needed for authentication
        unset($user->password_hash);

        // Return the UserModel object or null if no user was found
        return $user;
    }

    // Get one user by using the inherited function getOneRowByIdFromTable
    // Never send the password hash unless needed for authentication
    public function getByUsernameWithPassword($user_name)
    {
        // Define SQL query to retrieve user data by user_name
        $query = "SELECT * FROM users WHERE user_name = ?";

        // Prepare the query statement
        $stmt = $this->conn->prepare($query);

        // Bind the user_name parameter to the prepared statement
        $stmt->bind_param("s", $user_name);

        // Execute the query
        $stmt->execute();

        // Get the result of the query as a mysqli_result object
        $result = $stmt->get_result();

        // Fetch the user data as a UserModel object
        $user = $result->fetch_object("UserModel");

        // Return the UserModel object or null if no user was found
        return $user;
    }

    // Get one user by using the inherited function getOneRowByIdFromTable
    // Never send the password hash unless needed for authentication
    public function getByIdWithPassword($user_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

        $user = $result->fetch_object("UserModel");

        return $user;
    }

    // Get one user by using the inherited function getOneRowByIdFromTable
    public function getOne($user_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

        $user = $result->fetch_object("UserModel");

        return $user;
    }


    // Get all users by using the inherited function getAllRowsFromTable
    public function getAllById($user_id)
    {
        // $result = $this->getAllRowsFromTable($this->table_name);

        // $users = [];

        // while ($user = $result->fetch_object("UserModel")) {
        //     $users[] = $user;

        //     // Never send the password hash unless needed for authentication
        //     unset($user->password_hash);
        // }

        // return $users;

        $query = "SELECT * FROM users WHERE pt_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $users = array(); // Create an empty array to store the user objects

        while ($user = $result->fetch_object("UserModel")) {
            $users[] = $user; // Add each user object to the array
        }

        return $users; // Return the array of user objects
    }
    public function getAllByRole()
    {

        $query = "SELECT * FROM users WHERE role = ?";

        $stmt = $this->conn->prepare($query);
        $role = "PT"; 
        $stmt->bind_param("s", $role); 
        $stmt->execute();

        $result = $stmt->get_result();
        $users = array(); // Create an empty array to store the user objects

        while ($user = $result->fetch_object("UserModel")) {
            $users[] = $user; // Add each user object to the array
        }

        return $users; // Return the array of user objects
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(UserModel $user)
    {

        if ($user->pt_id !== null) {
        $query = "INSERT INTO users (user_name, password_hash, role, pt_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $user->user_name, $user->password_hash, $user->role, $user->pt_id);

        $success = $stmt->execute();



        } else {
        $query = "INSERT INTO users (user_name, password_hash, role) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $user->user_name, $user->password_hash, $user->role);

        $success = $stmt->execute();

        }
       return $success;  
    }

    // Update one by creating a query and using the inherited $this->conn 
    // public function updateById($user_id, UserModel $user)
    // {
    //     $query = "UPDATE users SET user_name=?, pt_id=? WHERE user_id=?;";

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bind_param("sii", $user->user_name, $user->pt_id, $user_id);

    //     $success = $stmt->execute();

    //     return $success;
    // }

    // public function updatePasswordById($user_id, $password_hash)
    // {
    //     $query = "UPDATE users SET password_hash=? WHERE user_id=?;";

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->bind_param("si", $password_hash, $user_id);

    //     $success = $stmt->execute();

    //     return $success;
    // }

    // Delete one user by using the inherited function deleteOneRowByIdFromTable
    public function deleteById($user_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

        return $success;
    }
}
