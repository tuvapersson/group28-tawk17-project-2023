<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit " . $this->model->customer_name);
?>

<h1>Edit <?= $this->model->customer_name ?></h1>

<form action="<?= $this->home ?>/customers/<?= $this->model->customer_id ?>/edit" method="post">
    <input type="text" name="customer_name" value="<?= $this->model->customer_name ?>" placeholder="Name"> <br>
    <input type="text" name="birth_year" value="<?= $this->model->birth_year ?>" placeholder="Birth year"> <br>
    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/customers/<?= $this->model->customer_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>