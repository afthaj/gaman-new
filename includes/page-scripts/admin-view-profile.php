<?php

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		$admin_levels = AdminLevel::find_all();

		if (isset($_POST['submit'])){
			$user->username = $_POST['username'];
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->email_address = $_POST['email_address'];
			$user->admin_level = $_POST['admin_level'];

			if ($user->update()){
				$session->message("Success! Your details were updated. ");
				redirect_to('admin_view_profile.php');
			} else {
				$session->message("Error! Your details could not be updated. ");
			}
		}

		if (isset($_POST['update'])){

			if ($_POST['old_password'] == $user->password){

				$user->password = $_POST['new_password'];

				if ($user->update()){
					$session->message("Success! Your password was updated. ");
					redirect_to('admin_view_profile.php');
				} else {
					$session->message("Error! Your password could not be updated. ");
				}
			} else {
				$session->message("Error! The existing password did not match. ");
			}

		}

		if (isset($_POST['upload'])){

			$photo = new Photograph();

			$photo->related_object_type = '5';
			$photo->related_object_id = $user->id;
			$photo->photo_type = 9; // photo_type 9 is "User Profile"
			$photo->attach_file_admin_user($_FILES['file_upload'], $user->id, $user->first_name, $user->last_name);

			if ($photo->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('admin-list-admin-users.php');
			} else {
				$message = join("<br />", $photo->errors);
			}

		}

	} else if ($session->object_type == 4) {
		//bus personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		$roles = BusPersonnelRole::find_all();
		$buses = Bus::find_all();

		if (isset($_POST['submit'])){
			$user->username = $_POST['username'];
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->nic_number = $_POST['nic_number'];
			$user->telephone_number = $_POST['telephone_number'];

			if ($user->update()){
				$session->message("Success! Your details were updated. ");
				redirect_to('admin-view-profile.php');
			} else {
				$session->message("Error! Your details could not be updated. ");
			}
		}

		if (isset($_POST['update'])){

			if ($_POST['old_password'] == $user->password){

				$user->password = $_POST['new_password'];

				if ($user->update()){
					$session->message("Success! Your password was updated. ");
					redirect_to('admin-view-profile.php');
				} else {
					$session->message("Error! Your password could not be updated. ");
				}
			} else {
				$session->message("Error! The existing password did not match. ");
			}

		}

		if (isset($_POST['upload'])){

			$photo = new Photograph();

			$photo->related_object_type = '4';
			$photo->related_object_id = $user->id;
			$photo->photo_type = 9; // photo_type 9 is "User Profile"
			$photo->attach_file_bus_personnel($_FILES['file_upload'], $user->id, $user->first_name, $user->last_name);

			if ($photo->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('admin-view-profile.php');
			} else {
				$message = join("<br />", $photo->errors);
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
