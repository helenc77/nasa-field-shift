<?php 
require_once(dirname(__FILE__).'/templates/header.php'); 
if($_SESSION['hc_loggedin'] != true ) {
    // Redirect
    header("Location: login.php"); 
}

$farmData = hcFarm\getFarmData($_SESSION['hc_id']);

if($farmData["location_ref"] !=''){
  	$latLng = explode(',',$farmData["location_ref"]);
} else {
  	$latLng ='';
}

if ($latLng !='') {

	$cropFamilies = hcFarm\getCropFamilies();
	$cropData = hcFarm\getCropData();

	$nasaPowerData = hcNasaPower\getClimatology(trim($latLng[0]),trim($latLng[1]),'GWETROOT,TSURF,PRECTOTCORR');
	$rootZoneSoilData = $nasaPowerData["properties"]["parameter"]["GWETROOT"];
	$surfaceTempLandSnowData = $nasaPowerData["properties"]["parameter"]["TSURF"];
	$precipitationData = $nasaPowerData["properties"]["parameter"]["PRECTOTCORR"];

	$annualAvgRainfall = $precipitationData['ANN'];
	$soilPh = $farmData["soil_ph"];

	?>

		<h1>Crops and rotation plan for <?php echo ($farmData["name"])?></h1>

		<?php 
		foreach($cropData as $crop){
			echo('<h2>'.$crop['name'].'</h2>
			<ul>
				<li>Crop family: '.$cropFamilies[$crop['crop_family']].'</li>
				<li>Max soil ph: '.$crop['max_soil_ph'].'</li>
				<li>Min soil ph: '.$crop['min_soil_ph'].'</li>
				<li>Ideal avg rainfall min: '.$crop['ideal_avg_rainfall_min'].'</li>
				<li>Ideal avg rainfall max: '.$crop['ideal_avg_rainfall_max'].'</li>
			</ul><p>');

			if($soilPh > $crop['max_soil_ph']){
				echo('Your soil PH is too high for this crop. ');
			} else if($soilPh < $crop['min_soil_ph']){
				echo('Your soil PH is too low for this crop. ');
			} else {
				echo('Your soil PH is ideal for this crop. ');
			}

			if($annualAvgRainfall > $crop['ideal_avg_rainfall_max']){
				echo('Your rainfall is too high for this crop. ');
			} else if($annualAvgRainfall < $crop['ideal_avg_rainfall_min']){
				echo('Your rainfall is too low for this crop. ');
			} else {
				echo('Your rainfall is ideal for this crop. ');
			}

			echo('</p>');
		}

	} else {
		echo('<h1>'.$farmData["name"].' data</h1><p>Please go to <a href=/profile.php>your profile</a> and set your location</p>');
	}

require_once(dirname(__FILE__).'/templates/footer.php'); ?>