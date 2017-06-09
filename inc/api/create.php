<?php
require 'db_config.php';

  $post = $_POST;


	VALUES ('".$post['address']."','".$post['latData']."','".$post['longData']."')";


  $result = $mysqli->query($sql);



  $result = $mysqli->query($sql);

  $data = $result->fetch_assoc();


echo json_encode($data);
?>
