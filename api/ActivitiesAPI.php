<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/ActivitiesService.php";

// Class for handling requests to "api/Activity"

class ActivitiesAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {
        
        
        // If theres two parts in the path and the request method is GET 
        // it means that the client is requesting "api/Activities" and
        // we should respond by returning a list of all activities 
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        } 

        // If there's three parts in the path and the request method is GET
        // it means that the client is requesting "api/Activities/{something}".
        // In our API the last part ({something}) should contain the ID of a 
        // activity and we should respond with the activity of that ID
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // If theres two parts in the path and the request method is POST 
        // it means that the client is requesting "api/Activities" and we
        // should get ths contents of the body and create a activity.
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }

        // If theres two parts in the path and the request method is PUT 
        // it means that the client is requesting "api/Activities/{something}" and we
        // should get the contents of the body and update the activity.
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        } 

        // If theres two parts in the path and the request method is DELETE 
        // it means that the client is requesting "api/Activities/{something}" and we
        // should get the ID from the URL and delete that activity.
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        } 
        
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }

    // Gets all activities and sends them to the client as JSON
    private function getAll()
    {
        $activities = ActivitiesService::getAllActivities();

        $this->sendJson($activities);
    }
    private function getByUserId()
    {
        $activities = ActivitiesService::getActivitiesByUserId();

        $this->sendJson($activities);
    }

    // Gets one and sends it to the client as JSON
    private function getById($id)
    {
        $activity = ActivitiesService::getActivityById($id);

        if ($activity) {
            $this->sendJson($activity);
        }
        else {
            $this->notFound();
        }
    }

    // Gets the contents of the body and saves it as a activity by 
    // inserting it in the database.
    private function postOne()
    {
        $activity = new ActivityModel();

        $activity->title = $this->body["title"];
        $activity->date = $this->body["date"];
        $activity->description = $this->body["description"];
        $activity->start_value = $this->body["start_value"];
        $activity->current_value = $this->body["current_value"];
        $activity->user_id = $this->body["user_id"];

        $success = ActivitiesService::saveActivity($activity);

        if($success){
            $this->created();
        }
        else{
            $this->error();
        }
    }

    // Gets the contents of the body and updates the activity
    // by sending it to the DB
    private function putOne($id)
    {
        $activity = new ActivityModel();

        $activity->title = $this->body["title"];
        $activity->date = $this->body["date"];
        $activity->description = $this->body["description"];
        $activity->start_value = $this->body["start_value"];
        $activity->current_value = $this->body["current_value"];
        $activity->user_id = $this->body["user_id"];

        $success = ActivitiesService::updateActivityById($id, $activity);

        if($success){
            $this->ok();
        }
        else{
            $this->error();
        }
    }

    // Deletes the activity with the specified ID in the DB
    private function deleteOne($id)
    {
        $activity = ActivitiesService::getActivityById($id);

        if($activity == null){
            $this->notFound();
        }

        $success = ActivitiesService::deleteActivityById($id);

        if($success){
            $this->noContent();
        }
        else{
            $this->error();
        }
    }
}
