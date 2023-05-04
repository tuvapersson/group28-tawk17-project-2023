<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model->user_name);
?>

<h1><?= $this->model->user_name ?></h1>

<p>
    <b>Id: </b>
    <?= $this->model->user_id ?> 
</p>

<p>
    <b>Name: </b>
    <?= $this->model->user_name ?> 
</p>
<p>
    <b>Role: </b>
    <?= $this->model->role ?> 
</p>
<p>
    <b>PT: </b>
    <?= $this->model->pt_id ?> 
</p>



<?php Template::footer(); ?>
