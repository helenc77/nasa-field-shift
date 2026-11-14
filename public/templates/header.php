<?php 
require_once dirname(__DIR__).'/../src/php/functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Basic Web App</title>
		<link rel="stylesheet" type="text/css" href="/css/style.min.css">
	</head>
	<body>
		<header><a href="/index.php">Basic web app</a>
			<nav>
				<ul>
					<?php  if(isset($_SESSION['hc_loggedin']) && $_SESSION['hc_loggedin'] == true ) { ?>
						<li>Welcome <?php echo($_SESSION['hc_name']) ?></li>
						<li><a href="/logout.php">Log out</a></li>
					<?php   } else { ?>
						<li><a href="/login.php">Log in</a></li>
						<li><a href="/register.php">Register</a></li>
					<?php  } ?>
				</ul>
			</nav>
		</header>
		<main>