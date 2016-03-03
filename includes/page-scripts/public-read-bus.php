<?php

$photo_types = $photo_type_object->get_photo_types("bus");
$photos_of_bus = $photo_object->get_photos(3, $_GET['busid']);

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6){
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	}
}

//GET request stuff
if (!empty($_GET['busid'])){
	$bus_to_read_update = $bus_object->find_by_id($_GET['busid']);
	if (!empty($user->id)){
		$feedback_by_user = $feedback_item_object->get_feedback_items_submitted_by_user_for_object($user->id, $session->object_type, 3, $bus_to_read_update->id);
		$complaints_by_user = $complaint_object->get_complaints_submitted_by_user_for_object($user->id, $session->object_type, 3, $bus_to_read_update->id);
	}
} else {
	$session->message("No Bus ID provided to view.");
	redirect_to("public-list-buses.php");
}

?>
