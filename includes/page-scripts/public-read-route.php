<?php

//init code
$routes = BusRoute::find_all();
$stops = BusStop::find_all();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6){
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);
	}
}

if (isset($_GET['routeid'])) {
	$route_to_read_update = $route_object->find_by_id($_GET['routeid']);
	$stops_routes = $stop_route_object->get_stops_for_route($route_to_read_update->id);
	if (!empty($user->id)){

		$feedback_by_user = $feedback_item_object->get_feedback_items_submitted_by_user_for_object($user->id, $session->object_type, 1, $route_to_read_update->id);
		$complaints_by_user = $complaint_object->get_complaints_submitted_by_user_for_object($user->id, $session->object_type, 1, $route_to_read_update->id);

	}
} else {
	$session->message("No Route ID provided to view.");
	redirect_to("public-list-routes.php");
}

?>
