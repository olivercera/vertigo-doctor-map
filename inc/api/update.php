<?php
  include 'utils.php';
  
  $id  = $_POST["id"];
  $post = $_POST;
  $lat = 0;
  $long = 0;
  $data_arr = geocode($post['address']);
  if($data_arr){
  	$lat = $data_arr[0];
  	$long = $data_arr[1];	
  }
  $sql = "UPDATE ".$wpdb->prefix ."vertigo_doctors SET provider_address = '".$post['address']."'
  	,provider_lat = '".$lat."',provider_long = '".$long."'
    ,provider_first_name = '".$post['firstname']."',provider_last_name = '".$post['lastname']."'
    ,provider_level = '".$post['level']."',provider_business_loc_add_phone = '".$post['phone']."'
    ,npi = '".$post['npi']."'
    WHERE id = '".$id."'";
  $wpdb->prepare($sql);
  $wpdb->query($sql);

  $sql = "SELECT * FROM ".$wpdb->prefix ."vertigo_doctors WHERE id = '".$id."'"; 

  $wpdb->prepare($sql);
  $result = $wpdb->get_results($sql);


echo json_encode($result);

?>