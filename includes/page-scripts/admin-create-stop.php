<?php

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])) {

			$stop_to_create = new BusStop();

			$stop_to_create->name = $_POST['name'];
			$stop_to_create->location_latitude = $_POST['location_latitude'];
			$stop_to_create->location_longitude = $_POST['location_longitude'];

			if ($stop_to_create->create()){
				$session->message("Success! The new Bus Stop has been added. ");
				redirect_to('admin-list-stops.php');
			} else {
				$session->message("Error! The Bus Stop could not be added. ");
			}
		}

	} else {
		$session->message("Error! You do not have sufficient priviledges to view the requested page. ");
		redirect_to("index.php");
	}

} else {
	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
