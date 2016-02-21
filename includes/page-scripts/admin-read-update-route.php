<?php

//init code
$stops = BusStop::find_all();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){
			$route_to_read_update->route_number = $_POST['route_number'];
			$route_to_read_update->length = $_POST['length'];
			$route_to_read_update->trip_time = $_POST['trip_time'];
			$route_to_read_update->begin_stop = $_POST['begin_stop'];
			$route_to_read_update->end_stop = $_POST['end_stop'];

			if ($route_to_read_update->update()){
				$session->message("Success! The Route details were updated. ");
				redirect_to('admin-list-routes.php');
			} else {
				$session->message("Error! The Route details could not be updated. ");
			}
		}

	} else if ($session->object_type == 4) {
		//bus personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else {
		$session->message("Error! You must login to view the requested page. ");
		redirect_to("login.php");
	}

} else {
	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

//GET request stuff
if (isset($_GET['routeid'])){

	$route_to_read_update = $route_object->find_by_id($_GET['routeid']);
	$stops_routes = $stop_route_object->get_stops_for_route($route_to_read_update->id);
	$complaints_of_route = $complaint_object->get_complaints_for_object(1, $_GET['routeid']);
	$feedback_on_route = $feedback_item_object->get_feedback_items_for_object(1, $_GET['routeid']);

} else {
	$session->message("No Route ID provided to view.");
	redirect_to("admin-list-routes.php");
}

?>
