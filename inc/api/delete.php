<?php

 $id  = $_POST["id"];

 $sql = "DELETE FROM ".$wpdb->prefix ."vertigo_doctors WHERE id = '".$id."'";
 $wpdb->prepare($sql);
 $wpdb->query($sql);

 echo json_encode([$id]);
 
?>