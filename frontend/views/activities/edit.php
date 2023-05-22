<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Activities");
?>
<h1>Edit Activity</h1>
<form action="<?= $this->home ?>/activities/<?= $this->model->activity_id ?>/edit" method="post">
    <input type="text" name="title" value="<?= $this->model->title ?>" placeholder="Title"> <br>
    <input type="text" name="date" value="<?= $this->model->date ?>" placeholder="Date"> <br>
    <input type="text" name="description" value="<?= $this->model->description ?>" placeholder="Description"> <br>
    <input type="text" name="start_value" value="<?= $this->model->start_value ?>" placeholder="Start Value"> <br>
    <input type="text" name="current_value" value="<?= $this->model->current_value ?>" placeholder="Current Value"> <br>
    <input type="hidden" name="user_id" value="<?= $this->model->user_id ?>">

    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/activities/<?= $this->model->activity_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>