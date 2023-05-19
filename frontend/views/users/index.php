<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Clients");
?>

<div class="item-grid">

    <?php foreach ($this->model as $user) : ?>

        <article class="item">
            <div>
                <b><?= $user->user_name ?></b> <br>
            </div>

            <a href="<?= $this->home ?>/users/<?= $user->user_id ?>">Show</a>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>