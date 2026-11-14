<?php

session_start();

$env = parse_ini_file(dirname(__DIR__).'/../.env');

require_once (dirname(__FILE__).'/../../src/php/database.php');
require_once (dirname(__FILE__).'/../../src/php/users.php');
require_once (dirname(__FILE__).'/../../src/php/form-handling.php');

?>