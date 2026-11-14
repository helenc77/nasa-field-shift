<?php 
require_once(dirname(__FILE__).'/templates/header.php'); 

use hcUsers\userRegister;
use function hcFormHandling\renderErrors as renderErrors;

$hc_errors = null;

if ($_POST) { //the form was submitted

  $hc_submitter = new userRegister($_POST);
  $hc_submitter->validate();
  $hc_submitter->insert();
  $hc_errors = $hc_submitter->getErrors();

  //if successfully submitted
  if ($hc_submitter->insertNewUser) {

    // Redirect
    header("Location: login.php?saved=1"); 

  }
}

?>

<form action="register.php" method="post">
<?php echo renderErrors($hc_errors); ?>
  <div class="form_field">
    <div class="form_field_label">
      <label for="name">Your name:</label> 
    </div>
    <div class="form_field_input">
      <input id="name" name="name" required type="text" />
    </div>
    <div class="form_field_help">
        Required. 
    </div>
  </div>

  <div class="form_field">
    <div class="form_field_label">
      <label for="email">Email:</label>
    </div>
    <div class="form_field_input">
      <input id="email" name="email" required type="email" />
    </div>
    <div class="form_field_help">
        Required. 
    </div>
  </div>
  
  <div class="form_field">
    <div class="form_field_label">
      <label for="password">Password:</label>
    </div>
    <div class="form_field_input">
      <input id="password" name="password" required type="password" />
    </div>
    <div class="form_field_help">
        Required. 
    </div>
  </div>

  <div class="form_field">
      <div class="form_field_label">
        <label for="confirm_password">Confirm password</label>
      </div>
      <div class="form_field_input">
        <input id="confirm_password" name="confirm_password" type="password" value="" required />
      </div>
      <div class="form_field_help">
        Passwords must be at least eight characters long and include a mix of lower-case and upper-case letters, numbers and these symbols: (!@£$%^&*)
      </div>
  </div>
  
  <div class="form_field">
    <div class="form_field_input">
      <input name="register" type="submit" value="Register" />
    </div>
  </div>  
  
</form>
<script src="js/form-handling.js"></script>
<script>
  checkPasswordsMatch();
</script>
<?php require_once(dirname(__FILE__).'/templates/footer.php'); ?>
