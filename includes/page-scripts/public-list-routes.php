<?php

//pagination code
$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$total_count = $route_object->count_all();
$pagination = new Pagination($current_page, $per_page, $total_count);

$sql  = "SELECT * FROM routes";
$sql .= " LIMIT " . $per_page;
$sql .= " OFFSET " . $pagination->offset();

$routes = $route_object->find_by_sql($sql);

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6){
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	}

}

?>
