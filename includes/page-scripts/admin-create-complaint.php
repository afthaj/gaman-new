<?php

//init code
$routes = BusRoute::find_all();
$stops = BusStop::find_all();
$buses = Bus::find_all();
$bus_personnel = BusPersonnel::find_all();
$complaint_types = ComplaintType::find_all();
$complaint_status = ComplaintStatus::find_all();
$object_types = ObjectType::find_all();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin_user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else if ($session->object_type == 4){
		//bus_personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else {
		//everyone else

		$session->message("Error! You do not have sufficient priviledges to view the requested page. ");
		redirect_to("index.php");
	}

	if (isset($_POST['submit'])){

		$complaint_to_create = new Complaint();

		if (isset($_POST['bus_route_id'])) {

			$complaint_to_create->related_object_type = 1;
			$complaint_to_create->related_object_id = $_POST['bus_route_id'];

		} else if (isset($_POST['stop_id'])) {

			$complaint_to_create->related_object_type = 2;
			$complaint_to_create->related_object_id = $_POST['stop_id'];

		} else if (isset($_POST['bus_id'])) {

			$complaint_to_create->related_object_type = 3;
			$complaint_to_create->related_object_id = $_POST['bus_id'];

		} else if (isset($_POST['bus_personnel_id'])) {

			$complaint_to_create->related_object_type = 4;
			$complaint_to_create->related_object_id = $_POST['bus_personnel_id'];

		}

		$complaint_to_create->user_object_type = $session->object_type;
		$complaint_to_create->user_id = $user->id;
		$complaint_to_create->complaint_type = $_POST['complaint_type'];
		$complaint_to_create->date_time_submitted = time();
		$complaint_to_create->status = $_POST['status'];
		$complaint_to_create->content = $_POST['content'];

		if ($complaint_to_create->create()){
			$session->message("Success! The Complaint has been submitted. ");
			redirect_to('admin-list-complaints.php');
		} else {
			$session->message("Error! The Complaint could not be submitted. ");
		}

	}

} else {
	//not logged in... GTFO!

	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
