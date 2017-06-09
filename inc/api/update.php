<?php
require 'db_config.php';


  $id  = $_POST["id"];
  $post = $_POST;
  $sql = "UPDATE ".dbTable." SET provider_address = '".$post['address']."'

    ,provider_lat = '".$post['latData']."',provider_long = '".$post['longData']."'

    WHERE id = '".$id."'";

  $result = $mysqli->query($sql);


  $sql = "SELECT * FROM ".dbTable." WHERE id = '".$id."'"; 

  $result = $mysqli->query($sql);

  $data = $result->fetch_assoc();


echo json_encode($data);
?>