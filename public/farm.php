<?php 
require_once(dirname(__FILE__).'/templates/header.php'); 
$farmData = hcFarm\getFarmData($_SESSION['hc_id']);
$latLng = explode(',',$farmData["location_ref"]);

$nasaPowerData = hcNasaPower\getClimatology(trim($latLng[0]),trim($latLng[1]),'GWETROOT,TSURF,PRECTOTCORR');
$rootZoneSoilData = $nasaPowerData["properties"]["parameter"]["GWETROOT"];
$surfaceTempLandSnowData = $nasaPowerData["properties"]["parameter"]["TSURF"];
$precipitationData = $nasaPowerData["properties"]["parameter"]["PRECTOTCORR"];

$googleAgUnderstandingData = hcAgUnderstanding\getGoogleAgUnderstanding($farmData["s2cellid"], $env["GOOGLE_CLOUD_AG_UNDERSTAND_API_KEY"]);
?>

	<h1><?php echo ($farmData["name"])?> data (location <?php echo ($farmData["location_ref"])?>)</h1>

	<?php foreach ($nasaPowerData["messages"] as $message) {
		echo('<p>'.$message.'</p>');
	}
	?>

	<h2>Root Zone Soil Wetness</h2>
	<p>The amount of water and water vapor available to plants in the root zone, generally considered to be the upper 1 m of soil, expressed as the proportion of water present in a given amount of soil. Values range from 0 for completely dry conditions to 1 for completely saturated soil.</p>
	<ul>
	<?php foreach ($rootZoneSoilData as $key => $val) {
		echo('<li>'.$key.': '.$val.'</li>');
	}
	?>
	</ul>

	<h2>Surface Temperature of Land and Snow</h2>
	<p>The estimate of surface temperature of land and snow; 0 to 0.018 m depth.</p>
	<ul>
	<?php foreach ($surfaceTempLandSnowData as $key => $val) {
		echo('<li>'.$key.': '.$val.'&deg;C</li>');
	}
	?>
	</ul>

	<h2>Precipitation Corrected</h2>
	<p>The average MERRA-2 bias corrected total precipitation at the surface of the earth.</p>
	<ul>
	<?php foreach ($precipitationData as $key => $val) {
		echo('<li>'.$key.': '.$val.' (mm/day)</li>');
	}
	?>
	</ul>

<?php require_once(dirname(__FILE__).'/templates/footer.php'); ?>