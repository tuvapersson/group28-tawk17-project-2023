<?php
require_once __DIR__ . "/../../Template.php";

Template::header("New User");
?>

<h1>New User</h1>

<form action="<?= $this->home ?>/users" method="post">
    <input type="text" name="user_name" placeholder="Name"> <br>
    <input type="text" name="password" placeholder="Password"> <br>
    <!-- <input type="text" name="role" placeholder="Role"> <br> -->
    <input type="radio" id="member" name="role" value="Member">
    <label for="Member">Member</label><br>
    <input type="radio" id="pt" name="role" value="PT">
    <label for="pt">PT</label><br>
    <input type="text" name="pt_id" placeholder="PT id"> <br>
    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>

