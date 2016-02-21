<?php

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6){
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_POST['submit'])){
			$user->username = $_POST['username'];
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->email_address = $_POST['email_address'];

			if ($user->update()){
				$session->message("Success! Your details were updated. ");
				redirect_to('public-view-profile.php');
			} else {
				$session->message("Error! Your details could not be updated. ");
			}
		}

		if (isset($_POST['update'])){

			if ($_POST['old_password'] == $user->password){

				$user->password = $_POST['new_password'];

				if ($admin_user->update()){
					$session->message("Success! The password was updated. ");
					redirect_to('public-view-profile.php');
				} else {
					$session->message("Error! The user details could not be updated. ");
				}
			} else {
				$session->message("Error! The existing password did not match. ");
			}

		}

		if (isset($_POST['upload'])){

			$photo = new Photograph();

			$photo->commuter_id = $user->id;
			$photo->photo_type = 9; // photo_type 9 is "User Profile"
			$photo->attach_file_commuter($_FILES['file_upload'], $user->id, $user->first_name, $user->last_name);

			if ($photo->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('public-view-profile.php');
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
