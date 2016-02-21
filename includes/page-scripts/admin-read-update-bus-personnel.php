<?php

//init code
$roles = BusPersonnelRole::find_all();
$buses = Bus::find_all();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_GET['personnelid'])){
			$bus_personnel_to_read_update = $bus_personnel_object->find_by_id($_GET['personnelid']);
			$profile_picture_of_bus_personnel = $photo_object->get_profile_picture('4', $bus_personnel_to_read_update->id);
			$complaints_of_bus_personnel = $complaint_object->get_complaints_for_object(4, $_GET['personnelid']);
			$feedback_on_bus_personnel = $feedback_item_object->get_feedback_items_for_object(4, $_GET['personnelid']);

		} else {
			$session->message("No Bus Personnel ID provided to view.");
			redirect_to("admin-list-bus-personnel.php");
		}

		if (isset($_POST['submit'])){
			$bus_personnel_to_read_update->role = $_POST['role'];
			$bus_personnel_to_read_update->username = $_POST['username'];
			$bus_personnel_to_read_update->first_name = $_POST['first_name'];
			$bus_personnel_to_read_update->last_name = $_POST['last_name'];
			$bus_personnel_to_read_update->nic_number = $_POST['nic_number'];

			if ($bus_personnel_to_read_update->update()){
				$session->message("Success! The Bus Personnel details were updated. ");
				redirect_to('admin-list-bus-personnel.php');
			} else {
				$session->message("Error! The Bus details could not be updated. ");
			}
		}

		if (isset($_POST['assign'])){

			$buses_bus_personnel_to_read_update = new BusBusPersonnel();

			$buses_bus_personnel_to_read_update->bus_id = $_POST['bus_id'];
			$buses_bus_personnel_to_read_update->bus_personnel_id = $bus_personnel_to_read_update->id;

			if ($buses_bus_personnel_to_read_update->create()){
				$session->message("Success! The Bus Personnel was assigned to the given Bus. ");
				redirect_to('admin-list-bus-personnel.php');
			} else {
				$session->message("Error! The Bus Personnel was not assigned to the given Bus. ");
			}
		}

		if (isset($_POST['update'])){
			if ($_POST['old_password'] == $bus_personnel_to_read_update->password) {

				$bus_personnel_to_read_update->password = $_POST['new_password'];

				if ($bus_personnel_to_read_update->update()){
					$session->message("Success! The user's password was updated. ");
					redirect_to('admin-list-bus-personnel.php');
				} else {
					$session->message("Error! The user's password could not be updated. ");
				}

			} else {
				$session->message("Error! The existing password did not match. ");
			}
		}

		if (isset($_POST['upload'])){

			$photo_to_upload = new Photograph();

			$photo_to_upload->related_object_type = '4';
			$photo_to_upload->related_object_id = $_GET['personnelid'];
			$photo_to_upload->photo_type = '9'; // photo_type 9 is "User Profile"

			$photo_to_upload->attach_file_bus_personnel($_FILES['file_upload'], $bus_personnel_to_read_update->id, $bus_personnel_to_read_update->first_name, $bus_personnel_to_read_update->last_name);

			if ($photo_to_upload->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('admin-list-bus-personnel.php');
			} else {
				$message = join("<br />", $photo_to_upload->errors);
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
