<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/ActivitiesDatabase.php";

class ActivitiesService{

    // Get one activity by creating a database object 
    // from data-access layer and calling its getOne function.
    // public static function getActivityById($id){
    //     $activities_database = new ActivitiesDatabase();

    //     $activity = $activities_database->getOne($id);

    //     // If you need to remove or hide data that shouldn't
    //     // be shown in the API response you can do that here
    //     // An example of data to hide is activities password hash 
    //     // or other secret/sensitive data that shouldn't be 
    //     // exposed to activities calling the API

    //     return $activity;
    // }
    public static function getActivityById($id){
        $activities_database = new ActivitiesDatabase();

        $activity = $activities_database->getOne($id);

        return $activity;
    }

    //////////////////// ADDED /////////////////////////
    public static function getActivityByUserId($id){
        $activities_database = new ActivitiesDatabase();

        $activities = $activities_database->getByUserId($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is activities password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to activities calling the API

        return $activities;
    }

    // Get all activities by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllActivities(){
        $activities_database = new ActivitiesDatabase();

        $activities = $activities_database->getAll();

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is activities password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to activities calling the API

        return $activities;
    }

    // Save a activity to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function saveActivity(ActivityModel $activity){
        $activities_database = new ActivitiesDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $activities_database->insert($activity);

        return $success;
    }

    // Update the activity in the database by creating a database object 
    // from data-access layer and calling its update function.
    public static function updateActivityById($activity_id, ActivityModel $activity){
        $activities_database = new ActivitiesDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $activities_database->updateById($activity_id, $activity);

        return $success;
    }

    // Delete the activity from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deleteActivityById($activity_id){
        $activities_database = new ActivitiesDatabase();

        // If you need to validate data or control what 
        // gets deleted from the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $activities_database->deleteById($activity_id);

        return $success;
    }

    /////////ADDED ///////////////
    public static function getActivitiesByUserId(){
        $activities_database = new ActivitiesDatabase();

        $activities = $activities_database->getByUserId();

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is activities password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to activities calling the API

        return $activities;
    }
}

