<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model["activity"]->activity_id);
?>

<h1><?= $this->model["activity"]->title ?></h1>

<p>
    <b>Id: </b>
    <?= $this->model["activity"]->activity_id ?>
</p>

<p>
    <b>Date: </b>
    <?= $this->model["activity"]->date ?>
</p>

<p>
    <b>Description: </b>
    <?= $this->model["activity"]->description ?>
</p>

<p>
    <b>Start value: </b>
    <?= $this->model["activity"]->start_value ?>
</p>
<p>
    <b>Current value: </b>
    <?= $this->model["activity"]->current_value ?>
</p>

<?php if ($this->user->user_role === "admin") : ?>

    <p>
        <b>User ID: </b>
        <?= $this->model["user"]->user_id ?>
    </p>

<?php endif; ?>


<?php Template::footer(); ?>