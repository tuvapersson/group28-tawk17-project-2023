<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit " . $this->model->user_name);
?>

<h1>Edit <?= $this->model->user_name ?></h1>

<form action="<?= $this->home ?>/users/<?= $this->model->user_id ?>/edit" method="post">
    <input type="text" name="user_name" value="<?= $this->model->user_name ?>" placeholder="Name"> <br>
    <input type="text" name="password" value="<?= $this->model->password ?>" placeholder="Password"> <br>
    <input type="text" name="pt_id" value="<?= $this->model->pt_id ?>" placeholder="PT"> <br>
    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/users/<?= $this->model->user_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>