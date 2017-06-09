<?php
	require_once("../../../../../wp-load.php");
	define("dbHost", "localhost");
	define("dbUser", "root");
	define("dbPass", "");
	define("dbName", $wpdb->dbname);
	define("dbTable", "wp_vertigo_doctors");
	$mysqli = new mysqli(dbHost, dbUser, dbPass, dbName);
?>