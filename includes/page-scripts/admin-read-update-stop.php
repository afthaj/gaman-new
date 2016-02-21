<?php

//init code
$stops = BusStop::find_all();

//GET request stuff
if (isset($_GET['stopid'])){
	$stop_to_read_update = $stop_object->find_by_id($_GET['stopid']);
	$stops_routes = $stop_route_object->get_routes_for_stop($stop_to_read_update->id);
	$complaints_of_stop = $complaint_object->get_complaints_for_object(2, $_GET['stopid']);
	$feedback_on_stop = $feedback_item_object->get_feedback_items_for_object(2, $_GET['stopid']);

} else {
	$session->message("No Stop ID provided to view.");
	redirect_to("admin-list-stops.php");
}

$photo_types = $photo_type_object->get_photo_types("bus_stop");
$photos_of_stop = $photo_object->get_photos('2', $_GET['stopid']);

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){
			$stop_to_read_update->name = $_POST['name'];
			$stop_to_read_update->location_latitude = $_POST['location_latitude'];
			$stop_to_read_update->location_longitude = $_POST['location_longitude'];

			if ($stop_to_read_update->update()){
				$session->message("Success! The Bus Stop details were updated. ");
				redirect_to('admin-list-stops.php');
			} else {
				$session->message("Error! The Bus Stop details could not be updated. ");
			}
		}

		if (isset($_POST['upload'])){

			$photo_to_upload = new Photograph();

			$photo_to_upload->related_object_type = '2';
			$photo_to_upload->related_object_id = $_GET['stopid'];
			$photo_to_upload->photo_type = $_POST['photo_type'];

			$photo_to_upload->attach_file_bus_stop($_FILES['file_upload'], $photo_to_upload->stop_id, $photo_to_upload->photo_type);

			if ($photo_to_upload->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('admin-list-stops.php');
			} else {
				$message = join("<br />", $photo_to_upload->errors);
			}

		}

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
