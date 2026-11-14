<?php 
require_once(dirname(__FILE__).'/templates/header.php'); 
$farmData = hcFarm\getFarmData($_SESSION['hc_id']);

?>

	<h1>Crop rotation plan for <?php echo ($farmData["name"])?></h1>

<?php require_once(dirname(__FILE__).'/templates/footer.php'); ?>