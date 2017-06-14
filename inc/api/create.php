<?php
  include 'utils.php';

  $post = $_POST;
  $lat = 0;
  $long = 0;
  $data_arr = geocode($post['address']);
  if($data_arr){
  	$lat = $data_arr[0];
  	$long = $data_arr[1];	
  }

  $sql = "INSERT INTO ".$wpdb->prefix ."vertigo_doctors (provider_address,provider_first_name, provider_last_name,  npi,  provider_level,  provider_business_loc_add_phone, provider_lat, provider_long) 
  VALUES ('".$post['address']."','".$post['firstname']."','".$post['lastname']."','".$post['npi']."','".$post['level']."','".$post['phone']."','".$lat."','".$long."')";

  $wpdb->prepare($sql);
  $wpdb->query($sql);

  $sql = "SELECT * FROM ".$wpdb->prefix ."vertigo_doctors Order by id asc LIMIT 1"; 
  $wpdb->prepare($sql);
  $result = $wpdb->get_results($sql);

  echo json_encode($result);


?>