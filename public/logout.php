<?php 
require_once(dirname(__FILE__).'/templates/header.php'); 
use hcUsers\userLogout;

$hc_populater = new userLogout();

// Redirect to the user's dashboard 
header("Location: index.php"); 

?>