
<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Weather");

?>

<h1>The Weather</h1>
<p>Welcome to the Weather section of our fitness app! Here, you can easily check the current weather conditions in your city to determine if it's the perfect time for a refreshing run. Whether you're a dedicated runner or just looking to incorporate some outdoor exercise into your routine, knowing the weather plays a crucial role in planning your fitness activities. Don't let the weather hinder your fitness goals – with our app, you'll be able to seize the right moments and make the most out of your workouts. Lace up your shoes, hit the pavement, and enjoy your run!</p>

<form action="" method="get">
    <input type="text" name="city" placeholder="City"> <br>
    <input type="submit" value="Show" class="btn">
</form>

<?php
// Check if the weather data exists and if the city is provided
if (isset($this->model["weather"]) && isset($_GET["city"])) {
    $city = $_GET["city"];
    $temperature = isset($this->model["weather"]["current"]["temp_c"]) ? $this->model["weather"]["current"]["temp_c"] : "";
    $condition = strtolower(isset($this->model["weather"]["current"]["condition"]["text"]) ? $this->model["weather"]["current"]["condition"]["text"] : "");
    $humidity = isset($this->model["weather"]["current"]["humidity"]) ? $this->model["weather"]["current"]["humidity"] : "";
    $wind_kph = isset($this->model["weather"]["current"]["wind_kph"]) ? $this->model["weather"]["current"]["wind_kph"] : "";
    
    if (!empty($temperature)) {
        echo "<h3>" . "Current weather in {$city}" . "</h3><br>";
        echo "It is currently {$condition} with a temperature of <b>{$temperature} degrees</b> in {$city}." . "<br>";
        echo "The humidity is {$humidity}, and it is blowing with a wind of {$wind_kph} km/h.";
        
    } else {
        echo "Temperature data is unavailable for {$city}.";
    }
}
?>




<?php Template::footer(); ?>