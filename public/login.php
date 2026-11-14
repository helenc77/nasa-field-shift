<?php 
require_once(dirname(__FILE__).'/templates/header.php'); 

use hcUsers\userLogin;
use function hcFormHandling\renderErrors as renderErrors;

$hc_errors = null;

if ($_POST) { 

  $hc_submitter = new userLogin($_POST);
  $hc_submitter->validate();
  $hc_submitter->getUser();
  $hc_errors = $hc_submitter->getErrors();

  if($hc_submitter->loggedin == 1){

    // Redirect to the user's dashboard 
    header("Location: index.php"); 

  }
}

?>

	<article>
		<form action="login.php" method="post">
			<h1>Login</h1>
			<div class="form_field">
				<div class="form_field_label">
				<label for="email">email:</label>
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
				<input id="password" name="password" required="" type="password" />
				</div>
				<div class="form_field_help">
					Required. 
				</div>
			</div>
			
			<div class="form_field">
				<div class="form_field_input">
				<input name="login" type="submit" value="Login" />
				</div>
			</div>  
		</form>
	</article>


<?php require_once(dirname(__FILE__).'/templates/footer.php'); ?>