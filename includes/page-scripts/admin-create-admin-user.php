<?php

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		$admin_levels = AdminLevel::find_all();

		if (isset($_POST['submit'])) {

			$user_to_create = new AdminUser();

			$user_to_create->username = $_POST['username'];
			$user_to_create->password = $_POST['password'];
			$user_to_create->admin_level = $_POST['admin_level'];
			$user_to_create->first_name = $_POST['first_name'];
			$user_to_create->last_name = $_POST['last_name'];
			$user_to_create->email_address = $_POST['email_address'];

			if ($user_to_create->create()){
				$session->message("Success! The Admin User has been added. ");
				redirect_to('admin-list-admin-users.php');
			} else {
				$session->message("Error! The Admin User could not be added. ");
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
