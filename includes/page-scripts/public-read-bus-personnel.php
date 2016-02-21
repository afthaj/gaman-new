<?php

//init code
$roles = BusPersonnelRole::find_all();
$buses = Bus::find_all();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6){
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);
	}
}

//GET request stuff
if (!empty($_GET['personnelid'])){
	$bus_personnel_to_read_update = $bus_personnel_object->find_by_id($_GET['personnelid']);
	$profile_picture_of_bus_personnel = $photo_object->get_profile_picture(4, $bus_personnel_to_read_update->id);
	$buses_bus_personnel = $bus_bus_personnel_object->get_buses_for_personnel($bus_personnel_to_read_update->id);
	if (!empty($user->id)){
		$feedback_by_user = $feedback_item_object->get_feedback_items_submitted_by_user_for_object($user->id, $session->object_type, 4, $bus_personnel_to_read_update->id);
		$complaints_by_user = $complaint_object->get_complaints_submitted_by_user_for_object($user->id, $session->object_type, 4, $bus_personnel_to_read_update->id);
	}

} else {
	$session->message("No Bus Personnel ID provided to view.");
	redirect_to("public-list-bus-personnel.php");
}

?>
