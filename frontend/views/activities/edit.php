<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit " . $this->model->activity_id);
?>

<h1>Edit <?= $this->model["activity"]->activity_id ?></h1>

<form action="<?= $this->home ?>/activities/<?= $this->model["activity"]->activity_id ?>/edit" method="post">
    <input type="text" name="title" value="<?= $this->model["activity"]->title ?>" placeholder="Title"> <br>
    <input type="text" name="date" value="<?= $this->model["activity"]->date ?>" placeholder="Date"> <br>
    <input type="text" name="description" value="<?= $this->model["activity"]->description ?>" placeholder="Description"> <br>
    <input type="text" name="start_value" value="<?= $this->model["activity"]->start_value ?>" placeholder="Start Value"> <br>
    <input type="text" name="current_value" value="<?= $this->model["activity"]->current_value ?>" placeholder="Current Value"> <br>
    <input type="hidden" name="user_id" value="<?= $this->model["user"]->user_id ?>">

    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/activities/<?= $this->model["activity"]->activity_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>