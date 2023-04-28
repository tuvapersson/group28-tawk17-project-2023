<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Customers");
?>

<h1>Customers</h1>

<a href="<?= $this->home ?>/customers/new">Create new</a>

<div class="item-grid">

    <?php foreach ($this->model as $customer) : ?>

        <article class="item">
            <div>
                <b><?= $customer->customer_name ?></b> <br>
                <span>Born: <?= $customer->birth_year ?></span> <br>
            </div>

            <a href="<?= $this->home ?>/customers/<?= $customer->customer_id ?>">Show</a>
            <a href="<?= $this->home ?>/customers/<?= $customer->customer_id ?>/edit">Edit</a>
        </article>

    <?php endforeach; ?>

</div>

<?php Template::footer(); ?>