<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/ActivityModel.php";

class ActivitiesDatabase extends Database
{
    private $table_name = "activities";
    private $id_name = "activity_id";

    // Get one activity by using the inherited function getOneRowByIdFromTable
    public function getOne($activity_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $activity_id);

        $activity = $result->fetch_object("ActivityModel");

        return $activity;
    }


    // Get all activities by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $activities = [];

        while ($activity = $result->fetch_object("ActivityModel")) {
            $activities[] = $activity;
        }

        return $activities;
    }

    public function getByUserId($user_id) {

        $query = "SELECT * FROM activities WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $activities = [];

        while ($activity = $result->fetch_object("ActivityModel")) {
            $activities[] = $activity;
        }
        return $activities;

        
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(ActivityModel $activity)
    {
        $query = "INSERT INTO activities (title, date, description, start_value, current_value, user_id) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssssi", $activity->title, $activity->date, $activity->description, $activity->start_value, $activity->current_value, $activity->user_id);

        $success = $stmt->execute();

        return $success;
    }

    // Update one by creating a query and using the inherited $this->conn 
    public function updateById($activity_id, ActivityModel $activity)
    {
        $query = "UPDATE activities SET title=?, date=?, description=?, start_value=?, current_value=? WHERE activity_id=?;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $activity->title, $activity->date, $activity->description, $activity->start_value, $activity->current_value, $activity_id);

        $success = $stmt->execute();

        return $success;
    }

    // Delete one activity by using the inherited function deleteOneRowByIdFromTable
    public function deleteById($activity_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $activity_id);

        return $success;
    }
}
