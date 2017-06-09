<?php
	define("dbHost", "localhost");
	define("dbUser", "root");
	define("dbPass", "");
	define("dbName", "wordpress");
	define("dbTable", "wp_vertigo_doctors");
	$mysqli = new mysqli(dbHost, dbUser, dbPass, dbName);
?>