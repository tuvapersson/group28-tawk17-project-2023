<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Activities");
?>

<a href="<?= $this->home ?>/activities/new">Create new</a>

<div class="item-grid">

    <?php foreach ($this->model as $activity) : ?>

        <article class="item">
            <div>
                <b><?= $activity->title ?></b> <br>
                <span>Current value: <?= $activity->current_value ?></span> <br>
            </div>

            <a href="<?= $this->home ?>/activities/<?= $activity->activity_id ?>">Show</a>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>