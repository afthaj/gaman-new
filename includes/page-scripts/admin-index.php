<?php

//init code
$fromtime1 = strtotime("-1 day");
$fromtime2 = strtotime("-3 day");
$fromtime3 = strtotime("-1 week");
$totime = time();

$feedback_items1 = $feedback_item_object->get_feedback_items_within_time($fromtime1, $totime);
$feedback_items2 = $feedback_item_object->get_feedback_items_within_time($fromtime2, $totime);
$feedback_items3 = $feedback_item_object->get_feedback_items_within_time($fromtime3, $totime);

$complaints1 = $complaint_object->get_complaints_within_time($fromtime1, $totime);
$complaints2 = $complaint_object->get_complaints_within_time($fromtime2, $totime);
$complaints3 = $complaint_object->get_complaints_within_time($fromtime3, $totime);

if ($session->is_logged_in()){
	// object_type = 5 is admin, 4 is bus_personnel, 6 is commuter

	if ($_SESSION['object_type'] == 5 ){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else if ($_SESSION['object_type'] == 4 ){
		//bus_personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else {
		//everybody else

		$session->message("Error! You do not have sufficient priviledges to view the requested page. ");
		redirect_to("index.php");
	}

} else {
	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
