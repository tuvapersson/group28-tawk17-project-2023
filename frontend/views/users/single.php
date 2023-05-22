<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Clients");
?>

<h1><?= $this->model["user"]->user_name ?></h1>

<p>
    <p>View <?= $this->model["user"]->user_name ?>'s activities:</p>
    
    <?php foreach ($this->model["activity"] as $activity) : ?>

<article class="item-row">
    <div class="inner-container-item">
        <b><?= $activity->title ?></b> <br>
        <a href="<?= $this->home ?>/activities/<?= $activity->activity_id ?>"><button class="btn">Show</button></a>
    </div>
</article>

<?php endforeach; ?>
</p>




<?php Template::footer(); ?>
