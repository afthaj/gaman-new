<?php

//init code
$complaint_statuses = $complaint_status_object->find_all();

//GET request stuff
$complaint_to_read_update = $complaint_object->find_by_id($_GET['complaintid']);

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin_user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){

			$complaint_to_read_update->status = $_POST['status'];
			$complaint_to_read_update->content = $_POST['content'];

			if ($complaint_to_read_update->update()){
				$session->message("Success! The Complaint details have been changed. ");
				redirect_to('admin_list_complaints.php');
			} else {
				$session->message("Error! The Complaint details could not be changed. ");
			}
		}
	} else if ($session->object_type == 4) {
		//bus_personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){

			$complaint_to_read_update->content = $_POST['content'];

			if ($complaint_to_read_update->update()){
				$session->message("Success! The Complaint details have been changed. ");
				redirect_to('admin-list-complaints.php');
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
