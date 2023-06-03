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
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        } 
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        }
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
        $this->requireAuth();
        if ($this->user->role === "PT") {
            $activities = ActivitiesService::getAllActivities();
        } else {
            $activities = ActivitiesService::getActivitiesByUser($this->user->user_id);
        }


        $this->sendJson($activities);
    }
    private function getByUserId()
    {
        $this->requireAuth();
        $activities = ActivitiesService::getActivitiesByUserId();

        if ($activities) {
            $this->sendJson($activities);
        }
        else {
            $this->notFound();
        }
    }

    private function getById($id)
    {
        $this->requireAuth();

        $activity = ActivitiesService::getActivityById($id);

        if (!$activity) {
            $this->notFound();
        }

        if ($this->user->role !== "PT" || $activity->user_id !== $this->user->user_id) {
            $this->forbidden();
        }

        $this->sendJson($activity);
    }

    private function postOne()
    {
        $this->requireAuth();

        $activity = new ActivityModel();

        $activity->title = $this->body["title"];
        $activity->date = $this->body["date"];
        $activity->description = $this->body["description"];
        $activity->start_value = $this->body["start_value"];
        $activity->current_value = $this->body["current_value"];
        $activity->user_id = $this->body["user_id"];

        if($this->user->user_role === "PT"){
            $activity->user_id = $this->body["user_id"];
        }

        else{
            $activity->user_id = $this->user->user_id;
        }

        $success = ActivitiesService::saveActivity($activity);

        if($success){
            $this->created();
        }
        else{
            $this->error();
        }
    }

    private function putOne($id)
    {
        $this->requireAuth();

        $activity = new ActivityModel();

        $activity->title = $this->body["title"];
        $activity->date = $this->body["date"];
        $activity->description = $this->body["description"];
        $activity->start_value = $this->body["start_value"];
        $activity->current_value = $this->body["current_value"];
        $activity->user_id = $this->body["user_id"];

        if($this->user->role === "PT"){
            $purchase->user_id = $this->body["user_id"];
        }

        else{
            $purchase->user_id = $this->user->user_id;
        }

        $success = ActivitiesService::updateActivityById($id, $activity);

        if($success){
            $this->ok();
        }
        else{
            $this->error();
        }
    }

    private function deleteOne($id)
    {
        $this->requireAuth();

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
