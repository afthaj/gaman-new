<?php

//init code
$photo_object = new Photograph();
$admin_user_object = new AdminUser();
$bus_personnel_object = new BusPersonnel();

$route_object = new BusRoute();
$bus_object = new Bus();
$bus_bus_personnel_object = new BusBusPersonnel();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){

		$session->message("The requested page is for use by Bus Personnel only. ");
		redirect_to("index.php");

	} else if ($session->object_type == 4) {
		//bus personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if ($user->role == 1 || $user->role == 4 || $user->role == 5){
			//bus_personnel that is logged in is an owner (role is 1 (Owner), 4 (Owner + Driver) or 5 (Owner + Conductor))
			$buses = $bus_bus_personnel_object->get_buses_for_personnel($user->id);
		} else if ($user->role == 2 || $user->role == 3) {
			//bus_personnel that is logged in is not an owner

			$buses = $bus_bus_personnel_object->get_buses_for_personnel($user->id);
		}

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
