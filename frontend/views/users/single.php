<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model["user"]->user_name);
?>

<h1><?= $this->model["user"]->user_name ?></h1>

<p>
    <b>Activites: </b>
    
    <?php foreach ($this->model["activity"] as $activity) : ?>

<article class="item">
    <div>
        <b><?= $activity->title ?></b> <br>
    </div>
</article>

<?php endforeach; ?>
</p>




<?php Template::footer(); ?>
