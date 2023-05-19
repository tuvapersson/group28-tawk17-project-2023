<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model["activity"]->title);
?>

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
<a href="<?= $this->home ?>/activities/<?= $this->model["activity"]->activity_id ?>/edit">Edit</a>


<?php Template::footer(); ?>