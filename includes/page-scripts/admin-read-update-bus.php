<?php

// this is to check if the user is the (owner), (owner + driver), or (owner + conductor)
$bp = new BusPersonnel();

$routes = BusRoute::find_all();
$buses = Bus::find_all();
$bus_personnel = BusPersonnel::find_all();

$photo_types = $photo_type_object->get_photo_types("bus");
$photos_of_bus = $photo_object->get_photos('3', $_GET['busid']);

//GET request stuff
if (isset($_GET['busid'])){
	$bus_to_read_update = $bus_object->find_by_id($_GET['busid']);
	$complaints_of_bus = $complaint_object->get_complaints_for_object(3, $_GET['busid']);
	$feedback_on_bus = $feedback_item_object->get_feedback_items_for_object(3, $_GET['busid']);

} else {
	$session->message("No Bus ID provided to view.");
	redirect_to("admin-list-buses.php");
}

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){
			$bus_to_read_update->route_id = $_POST['route_id'];
			$bus_to_read_update->reg_number = $_POST['reg_number'];
			$bus_to_read_update->name = $_POST['name'];

			if ($bus_to_read_update->update()){
				$session->message("Success! The Bus details were updated. ");
				redirect_to('admin-list-buses.php');
			} else {
				$session->message("Error! The Bus details could not be updated. ");
			}
		}

		if (isset($_POST['upload'])){

			$photo_to_upload = new Photograph();

			$photo_to_upload->related_object_type = '3';
			$photo_to_upload->related_object_id = $_GET['busid'];
			$photo_to_upload->photo_type = $_POST['photo_type'];

			$photo_to_upload->attach_file_bus($_FILES['file_upload'], $photo_to_upload->bus_id, $photo_to_upload->photo_type);

			if ($photo_to_upload->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('admin-list-buses.php');
			} else {
				$message = join("<br />", $photo_to_upload->errors);
			}

		}

		if (isset($_POST['assign'])){

			$buses_bus_personnel_to_read_update = new BusBusPersonnel();

			$buses_bus_personnel_to_read_update->bus_id = $_GET['busid'];
			$buses_bus_personnel_to_read_update->bus_personnel_id = $_POST['bus_personnel_id'];

			if ($buses_bus_personnel_to_read_update->create()){
				$session->message("Success! The Bus Personnel was assigned to the given Bus. ");
				redirect_to('admin-list-buses.php');
			} else {
				$session->message("Error! The Bus Personnel was not assigned to the given Bus. ");
			}
		}

	} else if ($session->object_type == 4){
		//bus personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){
			$bus_to_read_update->route_id = $_POST['route_id'];
			$bus_to_read_update->reg_number = $_POST['reg_number'];
			$bus_to_read_update->name = $_POST['name'];

			if ($bus_to_read_update->update()){
				$session->message("Success! The Bus details were updated. ");
				redirect_to('admin-list-buses.php');
			} else {
				$session->message("Error! The Bus details could not be updated. ");
			}
		}

		if (isset($_POST['upload'])){

			$photo_to_upload = new Photograph();

			$photo_to_upload->related_object_type = '3';
			$photo_to_upload->related_object_id = $_GET['busid'];
			$photo_to_upload->photo_type = $_POST['photo_type'];

			$photo_to_upload->attach_file_bus($_FILES['file_upload'], $photo_to_upload->bus_id, $photo_to_upload->photo_type);

			if ($photo_to_upload->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('admin-list-buses.php');
			} else {
				$message = join("<br />", $photo_to_upload->errors);
			}

		}

		if (isset($_POST['assign'])){

			$buses_bus_personnel_to_read_update = new BusBusPersonnel();

			$buses_bus_personnel_to_read_update->bus_id = $_GET['busid'];
			$buses_bus_personnel_to_read_update->bus_personnel_id = $_POST['bus_personnel_id'];

			if ($buses_bus_personnel_to_read_update->create()){
				$session->message("Success! The Bus Personnel was assigned to the given Bus. ");
				redirect_to('admin-list-buses.php');
			} else {
				$session->message("Error! The Bus Personnel was not assigned to the given Bus. ");
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

$bus_bus_personnel = $bus_bus_personnel_object->check_if_user_is_personnel_for_a_bus($user->id, $bus_to_read_update->id); //$personnel_for_bus

?>
