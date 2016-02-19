<?php

//init code
$routes = BusRoute::find_all();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5) {
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else if ($session->object_type == 4) {
		//bus personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else {
		//everyone else

		$session->message("Error! You do not have sufficient priviledges to view the requested page. ");
		redirect_to("index.php");
	}

} else {
	//not logged in... GTFO!

	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
