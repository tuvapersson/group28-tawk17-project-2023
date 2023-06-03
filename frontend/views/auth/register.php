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
    <select name="pt_id" class="pt-id">
    <option value="" disabled selected>Select your PT (optional)</option>
        <?php foreach ($this->model["available_admins"] as $user) : ?>
            <option value="<?php echo $user->user_id ?>"><?php echo $user->user_name; ?></option>
        <?php endforeach; ?>
    </select>
    
    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>