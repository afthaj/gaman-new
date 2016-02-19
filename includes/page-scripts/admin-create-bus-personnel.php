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

		if (isset($_POST['submit'])) {

			$bus_personnel_to_create = new BusPersonnel();
			//$buses_bus_personnel_to_create = new BusBusPersonnel();

			$bus_personnel_to_create->role = $_POST['role'];
			$bus_personnel_to_create->username = $_POST['username'];
			$bus_personnel_to_create->password = $_POST['password'];
			$bus_personnel_to_create->first_name = $_POST['first_name'];
			$bus_personnel_to_create->last_name = $_POST['last_name'];
			$bus_personnel_to_create->nic_number = $_POST['nic_number'];

			//$buses_bus_personnel_to_create->bus_id = $_POST['bus_id'];

			if ($bus_personnel_to_create->create()){

				$session->message("Success! The new Bus Personnel has been added. ");
				redirect_to('admin-list-bus-personnel.php');

				/*
				 $all_bus_personnel = BusPersonnel::find_all();

				for ($i = 0; $i = count($all_bus_personnel)-1; $i++){
				$all_bus_personnel[$i]->id = $buses_bus_personnel_to_create->bus_personnel_id;
				}

				if ($buses_bus_personnel_to_create->create()){
				$session->message("Success! The new Bus Personnel has been added. ");
				redirect_to('admin_list_personnel.php');
				} else {
				$session->message("Error! The new Bus Personnel could not be added to the given Bus Route. ");
				}
				*/

			} else {
				$session->message("Error! The new Bus Personnel could not be created. ");
			}
		}

	} else {
		$session->message("Error! You do not have sufficient priviledges to view the requested page. ");
		redirect_to("index.php");
	}

} else {
	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>
