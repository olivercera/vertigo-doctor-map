<?php
require 'db_config.php';

$post = $_POST;
$filters = json_decode(base64_decode($post['filters']), true);
$sqlFilters = "";
foreach ($filters as $key => $value) {
   if ($value != ""){
   	$value = strtolower($value);
   	$sqlFilters = $sqlFilters." AND LOWER({$key}) LIKE '%{$value}%'";
   }
}
//var_dump($sqlFilters);


$sql = "SELECT * FROM ".dbTable."  WHERE provider_lat BETWEEN {$post['minLat']} AND {$post['maxLat']} AND provider_long BETWEEN {$post['minLng']} AND {$post['maxLng']}"; 
$sql = $sql.$sqlFilters;

//var_dump($sql);

  $result = $mysqli->query($sql);

 $json = [];
  while($row = $result->fetch_assoc()){

     $json[] = $row;

  }

  $data['data'] = $json;

echo json_encode($data);

?>