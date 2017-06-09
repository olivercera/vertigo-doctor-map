<?php
require 'db_config.php';

  $post = $_POST;

  $sql = "INSERT INTO ".dbTable." (provider_address,provider_lat, provider_long) 

	VALUES ('".$post['address']."','".$post['latData']."','".$post['longData']."')";


  $result = $mysqli->query($sql);


  $sql = "SELECT * FROM ".dbTable." Order by id asc LIMIT 1"; 

  $result = $mysqli->query($sql);

  $data = $result->fetch_assoc();


echo json_encode($data);
?>