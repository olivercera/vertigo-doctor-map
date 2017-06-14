<?php

$num_rec_per_page = $_POST["items_per_page"];

if (isset($_POST["page"])) { $page  = $_POST["page"]; } else { $page=1; };

$start_from = ($page-1) * $num_rec_per_page;

$sqlTotal = "SELECT * FROM ".$wpdb->prefix .'vertigo_doctors';
$sql = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."vertigo_doctors Order By id asc LIMIT $start_from, $num_rec_per_page"); 

$result = $wpdb->get_results($sql);
$result2 = $wpdb->query($sqlTotal);

$data['data'] = $result;
$data['total'] = $result2;

echo json_encode($data);

?>