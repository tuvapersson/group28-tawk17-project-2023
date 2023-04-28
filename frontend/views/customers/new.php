<?php
require_once __DIR__ . "/../../Template.php";

Template::header("New Customer");
?>

<h1>New Customer</h1>

<form action="<?= $this->home ?>/customers" method="post">
    <input type="text" name="customer_name" placeholder="Name"> <br>
    <input type="text" name="birth_year" placeholder="Birth year"> <br>
    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>