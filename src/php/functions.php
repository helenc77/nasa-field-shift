<?php

session_start();

$env = parse_ini_file(dirname(__DIR__).'/../.env');

require_once (dirname(__FILE__).'/../../src/php/database.php');
require_once (dirname(__FILE__).'/../../src/php/users.php');
require_once (dirname(__FILE__).'/../../src/php/form-handling.php');
require_once (dirname(__FILE__).'/../../src/php/nasa-power.php');
require_once (dirname(__FILE__).'/../../src/php/google_ag_understanding.php');

function getFarmData($userId) {

    $conn = hcDatabase\dbConnect();
    $getUser = hcDatabase\dbSelect($conn, 'users', array('farm_id'), 'id = "'.$userId.'"', 1, null);
    $user = $getUser->fetch_assoc();
    $getFarm = hcDatabase\dbSelect($conn, 'farms', array('id, name, location_ref', 's2cellid'), 'id = "'.$user['farm_id'].'"', 1, null);
    $farm = $getFarm->fetch_assoc();
    hcDatabase\dbClose($conn);

    return $farm;

}

?>