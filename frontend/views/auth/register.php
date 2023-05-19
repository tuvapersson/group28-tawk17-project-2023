<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Register user", $this->model["error"]);
?>

<h1>Register user</h1>

<form action="<?= $this->home ?>/auth/register" method="post">
    <input type="text" name="user_name" placeholder="Username"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="password" name="confirm_password" placeholder="Confirm password"> <br>
    <!-- <input type="text" name="role" placeholder="Membership"> <br> -->
    <input type="radio" id="member" name="role" value="Member" onclick="showPtId();">
    <label for="role">Member</label>
    <input type="radio" id="pt" name="role" value="PT" onclick="hidePtId();">
    <label for="role">PT</label><br>
    <!-- <input type="number" name="pt_id" placeholder="PT" class="pt-id"> <br> -->
    <label for="pt" class="pt-id">Choose a PT:</label>
    <?php 
        //var_dump($this->model); ?>
    <select id="pt" name="pt" class="pt-id">
        <?php foreach ($this->model as $user) {
            if ($user->role == "PT") {
        ?>
        <option value="<?php echo $user->user_id ?>"><?php echo $user->user_name; ?></option>
        <?php
            }
        } ?>
    </select>
    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>