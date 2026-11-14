<?php require_once(dirname(__FILE__).'/../templates/header.php'); ?>

	<article>
		<div id="mapcontainer">
			<div id="map-canvas" style="height:400px; width:100%;"></div>
		</div>
	</article>
	<article>
		<form>
			<h2>Your nearest restaurants within <span id="noMiles">x</span> miles...</h2>
		</form>
		<ul id="restList"></ul>
	</article>

	<script>
		const googleMapsApiKey = "<?php echo $env["GOOGLE_MAPS_JS_API_KEY"]; ?>";
		const numMiles = 20;
	</script>
	<script src="/js/maps-load.js"></script>
	<script type="module" src="/js/maps-simple.js"></script>

<?php require_once(dirname(__FILE__).'/../templates/footer.php'); ?>