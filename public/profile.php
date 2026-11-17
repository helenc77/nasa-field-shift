<?php 
require_once(dirname(__FILE__).'/templates/header.php'); 
if($_SESSION['hc_loggedin'] != true ) {
    // Redirect
    header("Location: login.php"); 
}

$farmData = hcFarm\getFarmData($_SESSION['hc_id']);

if($farmData["location_ref"] !='') {
    $latLng = explode(',',$farmData["location_ref"]);
} else {
    $latLng ='';
}

use hcUsers\userRegister;
use function hcFormHandling\renderErrors as renderErrors;

$hc_errors = null;

if ($_POST) { //the form was submitted

  hcFarm\updateFarmData($farmData['id'], $_POST);

  // Redirect
  header("Location: index.php?saved=1"); 

  
}

?>

<form action="profile.php" method="post">
<?php echo renderErrors($hc_errors); ?>
  <div class="form_field">
    <div class="form_field_label">
      <label for="name">Farm name:</label> 
    </div>
    <div class="form_field_input">
      <input id="name" name="name" value="<?php echo $farmData['name']; ?>" required type="text" />
    </div>
    <div class="form_field_help">
        Required. 
    </div>
  </div>

  <div class="form_field">
    <div class="form_field_label">
      <label for="location_ref">Location:</label>
    </div>
    <div class="form_field_input">
      <input id="location_ref" name="location_ref" value="<?php echo $farmData['location_ref']; ?>" required type="location_ref" />
    </div>
    <div class="form_field_help">
        Required. Should be in the format of latitude, longitude e.g.  50.716667, -3.533333
    </div>
  </div>

    <div class="form_field">
    <div class="form_field_label">
      <label for="soil_ph">Soil ph:</label>
    </div>
    <div class="form_field_input">
      <select name="soil_ph" id="soil_ph" required>
        <option value="">--Please choose an option--</option>
        <option value="0" <?php if($farmData['soil_ph']=='0'){echo'selected';}?>>0</option>
        <option value="1" <?php if($farmData['soil_ph']=='1'){echo'selected';}?>>1</option>
        <option value="2" <?php if($farmData['soil_ph']=='2'){echo'selected';}?>>2</option>
        <option value="3" <?php if($farmData['soil_ph']=='3'){echo'selected';}?>>3</option>
        <option value="4" <?php if($farmData['soil_ph']=='4'){echo'selected';}?>>4</option>
        <option value="5" <?php if($farmData['soil_ph']=='5'){echo'selected';}?>>5</option>
        <option value="6" <?php if($farmData['soil_ph']=='6'){echo'selected';}?>>6</option>
        <option value="7" <?php if($farmData['soil_ph']=='7'){echo'selected';}?>>7</option>
        <option value="8" <?php if($farmData['soil_ph']=='8'){echo'selected';}?>>8</option>
        <option value="9" <?php if($farmData['soil_ph']=='9'){echo'selected';}?>>9</option>
        <option value="10" <?php if($farmData['soil_ph']=='10'){echo'selected';}?>>10</option>
        <option value="11" <?php if($farmData['soil_ph']=='11'){echo'selected';}?>>11</option>
        <option value="12" <?php if($farmData['soil_ph']=='12'){echo'selected';}?>>12</option>
        <option value="13" <?php if($farmData['soil_ph']=='13'){echo'selected';}?>>13</option>
        <option value="14" <?php if($farmData['soil_ph']=='14'){echo'selected';}?>>14</option>
      </select>
    </div>
    <div class="form_field_help">
        Required.
    </div>
  </div>

    <div class="form_field">
    <div class="form_field_label">
      <label for="soil_type">Soil type:</label>
    </div>
    <div class="form_field_input">
      <select name="soil_type" id="soil_type">
        <option value="">--Please choose an option--</option>
        <option value="clay" <?php if($farmData['soil_type']=='clay'){echo'selected';}?>>Clay</option>
        <option value="sandy" <?php if($farmData['soil_type']=='sandy'){echo'selected';}?>>Sandy</option>
        <option value="silt" <?php if($farmData['soil_type']=='silt'){echo'selected';}?>>Silt</option>
        <option value="loamy" <?php if($farmData['soil_type']=='loamy'){echo'selected';}?>>Loamy</option>
        <option value="peat" <?php if($farmData['soil_type']=='peat'){echo'selected';}?>>Peat</option>
        <option value="chalky" <?php if($farmData['soil_type']=='chalky'){echo'selected';}?>>Chalky</option>
      </select>
    </div>
    <div class="form_field_help">
        Optional.
    </div>
  </div>

    <div class="form_field">
    <div class="form_field_label">
      <label for="current_crop">Current crop:</label>
    </div>
    <div class="form_field_input">
      <select name="current_crop" id="current_crop">
        <option value="">--Please choose an option--</option>
        <option value="legumes" <?php if($farmData['current_crop']=='legumes'){echo'selected';}?>>Legumes</option>
        <option value="brassicas" <?php if($farmData['current_crop']=='brassicas'){echo'selected';}?>>Brassicas</option>
        <option value="nightshades" <?php if($farmData['current_crop']=='nightshades'){echo'selected';}?>>Nightshades</option>
        <option value="cucurbits" <?php if($farmData['current_crop']=='cucurbits'){echo'selected';}?>>Cucurbits</option>
        <option value="alliums" <?php if($farmData['current_crop']=='alliums'){echo'selected';}?>>Alliums</option>
        <option value="grass-cereal" <?php if($farmData['current_crop']=='grass-cereal'){echo'selected';}?>>Grass / Cereals</option>
      </select>
    </div>
    <div class="form_field_help">
        Optional.
    </div>
  </div>
  
  <div class="form_field">
    <div class="form_field_input">
      <input name="update" type="submit" value="Update" />
    </div>
  </div>  
  
</form>
<script src="js/form-handling.js"></script>
<?php require_once(dirname(__FILE__).'/templates/footer.php'); ?>
