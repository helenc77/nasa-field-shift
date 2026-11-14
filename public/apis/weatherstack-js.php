<?php require_once(dirname(__FILE__).'/../templates/header.php'); ?>

	<h1>Weatherstack API calls</h1>

	<article>
		<h2>Javascript version</h2>
		<p>The weather in <span id="this-location">location</span> is currently <span id="this-weather"> weather</span></p>

	</article>

	<?php  ?>

	<script>
		const weatherstackApiKey = "<?php echo $env["WEATHERSTACK_API_KEY"]; ?>";
	</script>
	<script src="/js/api-weatherstack.js"></script>


<?php require_once(dirname(__FILE__).'/../templates/footer.php'); ?>