<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Profile");
?>

<p>Logged in as <b><?= $this->user->user_name ?></b></p>
<?php 
    if ($this->user->role !== "PT" && $this->user->pt_id !== null) : ?>
    <p>PT: <b>
        <?= $this->model["user"]->user_name ?>
    </b></p>
    <?php endif ; ?>

<?php if ($this->user->role === "PT") : ?>
    <p>Admin</p>
<?php endif; ?>



<form action="<?= $this->home ?>/auth/logout" method="post">
    <input type="submit" value="Log out" class="btn delete-btn">
</form>

<?php Template::footer(); ?>