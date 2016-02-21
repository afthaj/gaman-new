<?php

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user
		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		$stops = BusStop::find_all();

		if (isset($_POST['submit'])) {

			$route_to_create = new Route();

			$route_to_create->route_number = $_POST['route_number'];
			$route_to_create->length = $_POST['length'];
			$route_to_create->trip_time = $_POST['trip_time'];
			$route_to_create->begin_stop = $_POST['begin_stop'];
			$route_to_create->end_stop = $_POST['end_stop'];

			if ($route_to_create->create()){
				$session->message("Success! The new Route has been added. ");
				redirect_to('admin-list-routes.php');
			} else {
				$session->message("Error! The Route could not be added. ");
			}
		}

	} else {
		$session->message("Error! You must login to view the requested page. ");
		redirect_to("login.php");
	}

} else {
	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
