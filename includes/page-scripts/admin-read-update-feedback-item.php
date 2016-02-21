<?php

//init code
$routes = BusRoute::find_all();
$stops = BusStop::find_all();
$buses = Bus::find_all();
$bus_personnel = BusPersonnel::find_all();
$complaint_types = ComplaintType::find_all();
$complaint_status = ComplaintStatus::find_all();

//GET request stuff
$feedback_item_to_read_update = $feedback_item_object->find_by_id($_GET['feedbackitemid']);

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5) {
		//admin_user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){

			$feedback_item_to_read_update->content = $_POST['content'];

			if ($feedback_item_to_read_update->update()){
				$session->message("Success! The Feedback Item details have been changed. ");
				redirect_to('admin-list-feedback-items.php');
			} else {
				$session->message("Error! The details of the Feedback Item could not be changed. ");
			}
		}

	} else if ($session->object_type == 4) {
		//bus_personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){

			$feedback_item_to_read_update->content = $_POST['content'];

		if ($feedback_item_to_read_update->update()){
				$session->message("Success! The Feedback Item details have been changed. ");
				redirect_to('admin-list-feedback-items.php');
			} else {
				$session->message("Error! The details of the Feedback Item could not be changed. ");
			}
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
