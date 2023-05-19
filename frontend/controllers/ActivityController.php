<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/ActivitiesService.php";

// Class for handling requests to "home/Activity"

class ActivityController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }


        // Path count is 2 meaning the current URL must be "/home/activities"
        // Load start page for activities
        if ($this->path_count == 2) {
            $this->showAll();
        }

        // Path count is 3 meaning the current URL must be "/home/activities/{SOMETHING}"
        // if {SOMETHING} id "new" we want to show the form for creating a activity
        else if ($this->path_count == 3 && $this->path_parts[2] == "new") {
            $this->showNewActivityForm();
        }

        // Path count is 3 meaning the current URL must be "/home/activities/{SOMETHING}"
        // {SOMETHING} is probably the activity_id
        else if ($this->path_count == 3) {
            $this->showOne();
        }


        // Path count is 4 meaning the current URL must be "/home/activities/{SOMETHING1}/{SOMETHING2}"
        // {SOMETHING1} is probably the activity_id
        // if {SOMETHING2} is "edit" we will show the edit form
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->showEditForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }



    // Gets all activities and shows them in the index view
    private function showAll()
    {
    
        $this->requireAuth();

        if ($this->user->role === "PT") {
            $activities = ActivitiesService::getAllActivities();
        } else {
            $activities = ActivitiesService::getActivityByUserId($this->user->user_id);
        }

        // $this->model is used for sending data to the view
        $this->model = $activities;

        $this->viewPage("activities/index");
    }



    // Gets one activity and shows the in the single activity-view
    private function showOne()
    {
        // Get the activity with the ID from the URL
        $activity = $this->getActivity();

        // $this->model is used for sending data to the view
        $this->model["activity"] = $activity;

        // Shows the view file activities/single.php
        $this->viewPage("activities/single");
    }



    // Gets one activity and shows the in the edit activity-view
    private function showEditForm()
    {
        $this->requireAuth();
        // Get the activity with the ID from the URL
        $activity = $this->getActivity();

        // $this->model is used for sending data to the view
        $this->model = $activity;

        // Shows the view file activities/edit.php
        $this->viewPage("activities/edit");
    }



    // Gets one activity and shows the in the edit activity-view
    private function showNewActivityForm()
    {
        $this->requireAuth();
        // Shows the view file activities/new.php
        $this->viewPage("activities/new");
    }



    // Gets one activity based on the id in the url
    private function getActivity()
    {
        $this->requireAuth();

        // Get the activity with the specified ID
        $id = $this->path_parts[2];
        $activity = ActivitiesService::getActivityById($id);

        // Show not found if activity doesn't exist
        if ($activity == null) {
            $this->notFound();
        }

        return $activity;
    }


    // handle all post requests for activities in one place
    private function handlePost()
    {
        // Path count is 2 meaning the current URL must be "/home/activities"
        // Create a activity
        if ($this->path_count == 2) {
            $this->createActivity();
        }

        // Path count is 4 meaning the current URL must be "/home/activities/{SOMETHING1}/{SOMETHING2}"
        // {SOMETHING1} is probably the activity_id
        // if {SOMETHING2} is "edit" we will update the activity
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->updateActivity();
        }

        // Path count is 4 meaning the current URL must be "/home/activities/{SOMETHING1}/{SOMETHING2}"
        // {SOMETHING1} is probably the activity_id
        // if {SOMETHING2} is "edit" we will show the edit form
        else if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deleteActivity();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    // Create a activity with data from the URL and body
    private function createActivity()
    {
        $this->requireAuth();

        $activity = new ActivityModel();

        // Get updated properties from the body
        $activity->title = $this->body["title"];
        $activity->date = $this->body["date"];
        $activity->description = $this->body["description"];
        $activity->start_value = $this->body["start_value"];
        $activity->current_value = $this->body["current_value"];
        $activity->user_id = $this->body["user_id"];

        // Save the activity
        $success = ActivitiesService::saveActivity($activity);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/activities");
        } else {
            $this->error();
        }
    }


    // Update a activity with data from the URL and body
    private function updateActivity()
    {
        $this->requireAuth();
        $activity = new ActivityModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        // Get updated properties from the body
        $activity->title = $this->body["title"];
        $activity->date = $this->body["date"];
        $activity->description = $this->body["description"];
        $activity->start_value = $this->body["start_value"];
        $activity->current_value = $this->body["current_value"];
        $activity->user_id = $this->body["user_id"];

        // Update the activity
        $success = ActivitiesService::updateActivityById($id, $activity);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/activities");
        } else {
            $this->error();
        }
    }


    // Delete a activity with data from the URL
    private function deleteActivity()
    {
        $this->requireAuth();
        // Get ID from the URL
        $id = $this->path_parts[2];

        // Delete the activity
        $success = ActivitiesService::deleteActivityById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/activities");
        } else {
            $this->error();
        }
    }
}
