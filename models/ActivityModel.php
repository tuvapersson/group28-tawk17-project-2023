<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for activities-table in database
class ActivityModel{
    public $activity_id;
    public $title;
    public $date;
    public $description;
    public $start_value;
    public $current_value;
    public $user_id;
}