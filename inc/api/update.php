<?php
require 'db_config.php';


  $id  = $_POST["id"];
  $post = $_POST;
  $lat = 0;
  $long = 0;
  $data_arr = geocode($post['address']);
  if($data_arr){
  	$lat = $data_arr[0];
  	$long = $data_arr[1];	
  }
  $sql = "UPDATE ".dbTable." SET provider_address = '".$post['address']."'
  	,provider_lat = '".$lat."',provider_long = '".$long."'
    ,provider_first_name = '".$post['firstname']."',provider_last_name = '".$post['lastname']."'
    ,provider_level = '".$post['level']."',provider_business_loc_add_phone = '".$post['phone']."'
    ,npi = '".$post['npi']."'
    WHERE id = '".$id."'";
  $result = $mysqli->query($sql);


  $sql = "SELECT * FROM ".dbTable." WHERE id = '".$id."'"; 

  $result = $mysqli->query($sql);

  $data = $result->fetch_assoc();


echo json_encode($data);
function geocode($address){

	// url encode the address
	$address = urlencode($address);
	 
	// google map geocode api url
	$url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
	// get the json response
	$resp_json = file_get_contents($url);
	
	// decode the json
	$resp = json_decode($resp_json, true);

	// response status will be 'OK', if able to geocode given address 
	if($resp['status']=='OK'){

		// get the important data
		$lati = $resp['results'][0]['geometry']['location']['lat'];
		$longi = $resp['results'][0]['geometry']['location']['lng'];
		$formatted_address = $resp['results'][0]['formatted_address'];
		// verify if data is complete
		if($lati && $longi && $formatted_address){
		
			// put the data in the array
			$data_arr = array();			
			
			array_push(
				$data_arr, 
					$lati, 
					$longi, 
					$formatted_address
				);
			
			return $data_arr;
			
		}else{
			return false;
		}
		
	}else{
		return false;
	}
}
?>