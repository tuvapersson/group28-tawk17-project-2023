<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Weather");
?>

<h1>Welcome the weather</h1>

<form action="" method="get">
    <input type="text" name="city" placeholder="City"> <br>
    <input type="submit" value="Show" class="btn">
</form>


<?= isset($this->model["weather"]["current"]["temp_c"]) ? $this->model["weather"]["current"]["temp_c"] : "" ?>




<?php Template::footer(); ?>