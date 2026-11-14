<?php require_once(dirname(__FILE__).'/../templates/header.php'); 

require_once (dirname(__FILE__).'/../../src/php/weatherstack.php');
use function hcWeatherstack\getCurrentWeather;
$currentWeatherHere = getCurrentWeather($env["WEATHERSTACK_API_KEY"]);
$thisLocation = $currentWeatherHere['location']['name'];
$thisWeather = implode(",", $currentWeatherHere['current']['weather_descriptions']);

?>

	<h1>Weatherstack API calls</h1>

	<article>
		<h2>Php version</h2>
		<p>The weather in <?php echo($thisLocation); ?> is currently <?php echo($thisWeather); ?></p>

	</article>


<?php require_once(dirname(__FILE__).'/../templates/footer.php'); ?>