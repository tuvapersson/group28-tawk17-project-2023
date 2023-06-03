<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/ActivitiesDatabase.php";

class ActivitiesService{

    public static function getActivityById($id){
        $activities_database = new ActivitiesDatabase();

        $activity = $activities_database->getOne($id);

        return $activity;
    }

    public static function getActivityByUserId($id){
        $activities_database = new ActivitiesDatabase();

        $activities = $activities_database->getByUserId($id);

        return $activities;
    }

    public static function getAllActivities(){
        $activities_database = new ActivitiesDatabase();

        $activities = $activities_database->getAll();

        return $activities;
    }

    public static function saveActivity(ActivityModel $activity){
        $activities_database = new ActivitiesDatabase();

        $success = $activities_database->insert($activity);

        return $success;
    }

    public static function updateActivityById($activity_id, ActivityModel $activity){
        $activities_database = new ActivitiesDatabase();

        $success = $activities_database->updateById($activity_id, $activity);

        return $success;
    }

    public static function deleteActivityById($activity_id){
        $activities_database = new ActivitiesDatabase();

        $success = $activities_database->deleteById($activity_id);

        return $success;
    }

    public static function getActivitiesByUserId(){
        $activities_database = new ActivitiesDatabase();

        $activities = $activities_database->getByUserId();

        return $activities;
    }
}

