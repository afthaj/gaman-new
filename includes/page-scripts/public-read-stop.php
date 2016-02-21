<?php

//init code
$stops = $stop_object->find_all();

$photo_types = $photo_type_object->get_photo_types("bus_stop");
$photos_of_stop = $photo_object->get_photos(2, $_GET['stopid']);

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6){
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	}

}

//GET request stuff
if (!empty($_GET['stopid'])){
	$stop_to_read_update = $stop_object->find_by_id($_GET['stopid']);
	$stops_routes = $stop_route_object->get_routes_for_stop($stop_to_read_update->id);
	if (!empty($user->id)){
		$feedback_by_user = $feedback_item_object->get_feedback_items_submitted_by_user_for_object($user->id, $session->object_type, 2, $stop_to_read_update->id);
		$complaints_by_user = $complaint_object->get_complaints_submitted_by_user_for_object($user->id, $session->object_type, 2, $stop_to_read_update->id);
	}

} else {
	$session->message("No Stop ID provided to view.");
	redirect_to("public-list-stops.php");
}

?>
