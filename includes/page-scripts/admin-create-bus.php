<?php

//init code
$routes = BusRoute::find_all();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])) {

			$bus_to_create = new Bus();

			$bus_to_create->route_id = $_POST['route_id'];
			$bus_to_create->reg_number = $_POST['reg_number'];
			$bus_to_create->name = $_POST['name'];

			if ($bus_to_create->create()){
				$session->message("Success! The new Bus has been added. ");
				redirect_to('admin-list-buses.php');
			} else {
				$session->message("Error! The Bus could not be added. ");
			}
		}

	} else {
		//everyone else

		$session->message("Error! You do not have sufficient priviledges to view the requested page. ");
		redirect_to("./");
	}

} else {
	//not logged in... GTFO!

	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
