<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Activities");
?>

<h1>Activities</h1>

<a href="<?= $this->home ?>/activities/new">Create new</a>

<div class="item-grid">

    <?php foreach ($this->model["activity"] as $activity) : ?>

        <article class="item">
            <div>
                <b><?= $activity->title ?></b> <br>
                <span>Current value: <?= $activity->current_value ?></span> <br>
            </div>


            <?php if ($this->user->user_role === "admin") : ?>

                <p>
                    <b>User ID: </b>
                    <?= $activity->user_id ?>
                </p>
            <a href="<?= $this->home ?>/activities/<?= $activity->activity_id ?>/edit">Edit</a>

            <?php endif; ?>

            <a href="<?= $this->home ?>/activities/<?= $activity->activity_id ?>">Show</a>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>