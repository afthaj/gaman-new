<?php

//init code
$routes = BusRoute::find_all();
$stops = BusStop::find_all();
$buses = Bus::find_all();
$bus_personnel = BusPersonnel::find_all();
$complaint_types = ComplaintType::find_all();
$complaint_status = ComplaintStatus::find_all();

//GET request stuff
$complaint_to_read_update = $complaint_object->find_by_id($_GET['complaintid']);

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6) {

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){
			$complaint_to_read_update->status = $_POST['status'];
			$complaint_to_read_update->content = $_POST['content'];

			if ($complaint_to_read_update->update()){
				$session->message("Success! The Complaint details have been changed. ");
				redirect_to('public-list-complaints.php');
			} else {
				$session->message("Error! The Complaint details could not be changed. ");
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
