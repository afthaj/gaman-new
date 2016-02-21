<?php

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		$admin_levels = AdminLevel::find_all();

		if (isset($_GET['adminid'])){

			$user_to_read_update = $admin_user_object->find_by_id($_GET['adminid']);
			$profile_picture_of_other_admin_users = $photo_object->get_profile_picture($session->object_type, $user_to_read_update->id);

		} else {
			$session->message("Error! No Admin ID provided to view.");
			redirect_to("admin-list-admin-users.php");
		}

		if (isset($_POST['submit'])){

			$user_to_read_update->username = $_POST['username'];
			$user_to_read_update->admin_level = $_POST['admin_level'];
			$user_to_read_update->first_name = $_POST['first_name'];
			$user_to_read_update->last_name = $_POST['last_name'];
			$user_to_read_update->email_address = $_POST['email_address'];

			if ($user_to_read_update->update()){
				$session->message("Success! The user details were updated. ");
				redirect_to('admin-list-admin-users.php');
			} else {
				$session->message("Error! The user details could not be updated. ");
			}
		}

		if (isset($_POST['update'])){
			if ($_POST['old_password'] == $user_to_read_update->password) {

				$user_to_read_update->password = $_POST['new_password'];

				if ($user_to_read_update->update()){
					$session->message("Success! The user's password was updated. ");
					redirect_to('admin-list-admin-users.php');
				} else {
					$session->message("Error! The user's password could not be updated. ");
				}

			} else {
				$session->message("Error! The existing password did not match. ");
			}
		}

		if (isset($_POST['upload'])){

			$photo_to_upload = new Photograph();

			$photo_to_upload->related_object_type = '5';
			$photo_to_upload->related_object_id = $_GET['adminid'];
			$photo_to_upload->photo_type = '9'; // photo_type 9 is "User Profile"

			$photo_to_upload->attach_file_admin_user($_FILES['file_upload'], $user_to_read_update->id, $user_to_read_update->first_name, $user_to_read_update->last_name);

			if ($photo_to_upload->save()){
				$session->message("Success! The photo was uploaded successfully. ");
				redirect_to('admin-list-admin-users.php');
			} else {
				$message = join("<br />", $photo_to_upload->errors);
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
