<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Activities");
?>

<a href="<?= $this->home ?>/activities/new"><button class="btn accent-btn">Create new</button></a>

<div class="item-grid">

    <?php foreach ($this->model as $activity) : ?>

        <article class="item">
            <div>
                <b><?= $activity->title ?></b> <br>
                <span>Current value: <?= $activity->current_value ?></span> <br>
            </div>

            <a href="<?= $this->home ?>/activities/<?= $activity->activity_id ?>"><button class="btn">Show</button></a>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>