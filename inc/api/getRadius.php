<?php
$post = $_POST;
$filters = json_decode(base64_decode($post['filters']), true);
$sqlFilters = "";
foreach ($filters as $key => $value) {
   if ($value != ""){
   	$value = strtolower($value);
   	$sqlFilters = $sqlFilters." AND LOWER({$key}) LIKE '%{$value}%'";
   }
}
$sql = "SELECT id, provider_first_name, provider_last_name, provider_address, provider_lat, provider_long, npi,provider_level, ( 3959  * acos( cos( radians({$post['lat']}) ) * cos( radians( provider_lat ) ) * cos( radians( provider_long ) - radians({$post['lng']}) ) + sin( radians({$post['lat']}) ) * sin( radians( provider_lat ) ) ) ) AS distance FROM ".$wpdb->prefix ."vertigo_doctors HAVING distance < {$post['distance']}"; 
$sql = $sql.$sqlFilters;
$wpdb->prepare($sql);
$result = $wpdb->get_results($sql);

  $data['data'] = $result;

echo json_encode($data);

?>