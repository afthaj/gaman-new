<?php

//init code
$routes = BusRoute::find_all();
$stops = BusStop::find_all();
$buses = Bus::find_all();
$bus_personnel = BusPersonnel::find_all();

$object_types = $object_type_object->get_main_object_types();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6) {
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture(6, $user->id);

		if (isset($_POST['submit'])){
			$feedback_item_to_create = new FeedbackItem();

			$feedback_item_to_create->bus_route_id = $_POST['bus_route_id'];
			$feedback_item_to_create->stop_id = $_POST['stop_id'];
			$feedback_item_to_create->bus_id = $_POST['bus_id'];
			$feedback_item_to_create->bus_personnel_id = $_POST['bus_personnel_id'];
			$feedback_item_to_create->content = $_POST['content'];

			if (isset($_POST['bus_route_id'])) {

				$feedback_item_to_create->related_object_type = 1;
				$feedback_item_to_create->related_object_id = $_POST['bus_route_id'];

			} else if (isset($_POST['stop_id'])) {

				$feedback_item_to_create->related_object_type = 2;
				$feedback_item_to_create->related_object_id = $_POST['stop_id'];

			} else if (isset($_POST['bus_id'])) {

				$feedback_item_to_create->related_object_type = 3;
				$feedback_item_to_create->related_object_id = $_POST['bus_id'];

			} else if (isset($_POST['bus_personnel_id'])) {

				$feedback_item_to_create->related_object_type = 4;
				$feedback_item_to_create->related_object_id = $_POST['bus_personnel_id'];

			}

			$feedback_item_to_create->user_object_type = $session->object_type;
			$feedback_item_to_create->user_id = $user->id;
			$feedback_item_to_create->date_time_submitted = time();
			$feedback_item_to_create->content = $_POST['content'];

			if ($feedback_item_to_create->create()){
				$session->message("Success! The Complaint has been submitted. ");
				redirect_to('public-list-feedback-items.php');
			} else {
				$session->message("Error! The Feedback could not be submitted. ");
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
