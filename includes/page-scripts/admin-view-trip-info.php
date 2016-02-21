<?php
//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else {
		$session->message("Error! You must login to view the requested page. ");
		redirect_to("login.php");
	}

	//GET request stuff
	if (!empty($_GET['tripid'])){

		$trip_to_read = $trip_object->find_by_id($_GET['tripid']);
		$stop_activities = $stop_activity_object->get_stop_activities_for_trip($trip_to_read->id);

	} else {

		$session->message("No Trip was selected.");
		redirect_to("admin-list-routes.php");

	}

} else {
	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
