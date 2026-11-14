<?php require_once(dirname(__FILE__).'/templates/header.php'); ?>

	<h1>Basic web app</h1>
	<section class="grid">
		<article class="grid-item">
			<h2>Farm Data</h2>
			<ul>
				<li><a href="/farm.php">Farm data</a></li>
				<li><a href="/maps/simple-map.php">Simple map</a></li>
				<li><a href="/maps/route.php">Route</a></li>
				<li><a href="/maps/nearby-search.php">Nearby Search</a></li>
			</ul>
		</article>
		<article class="grid-item">
			<h2>Api stuff</h2>
			<ul>
				<li><a href="/apis/weatherstack-php.php">Weatherstack api with PHP</a></li>
				<li><a href="/apis/weatherstack-js.php">Weatherstack api with Javascript</a></li>
			</ul>
		</article>
	</section>

<?php require_once(dirname(__FILE__).'/templates/footer.php'); ?>