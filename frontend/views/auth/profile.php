<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Profile");
?>

<p>
    Logged in as <b><?= $this->user->user_name ?></b>
    PT: <b><?= $this->user->pt_id ?></b>
</p>

<?php if ($this->user->role === "PT") : ?>
    <p>Admin</p>
<?php endif; ?>




<h2>Log out</h2>
<form action="<?= $this->home ?>/auth/logout" method="post">
    <input type="submit" value="Log out" class="btn delete-btn">
</form>

<?php Template::footer(); ?>