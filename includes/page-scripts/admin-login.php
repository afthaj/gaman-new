<?php

//init code
$object_type_admin = $object_type_object->get_object_type_by_name("admin");
$object_type_bus_personnel = $object_type_object->get_object_type_by_name("bus_personnel");

//check login
if ($session->is_logged_in()){
	redirect_to("index.php");
}

if (isset($_POST['submit'])){

	$object_type = trim($_POST['object_type']);

	if ($object_type == 5 /*$object_type_admin->id*/) {

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$found_user_admin = $admin_user_object->authenticate($username, $password);

		if ($found_user_admin){
			$session->login($found_user_admin, $object_type_admin->id);
			redirect_to("index.php");
		} else {
			$session->message("username/password combination is incorrect. ");
		}

	} else if ($object_type == 4 /*$object_type_bus_personnel->id*/) {

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$found_user_bus_personnel = $bus_personnel_object->authenticate($username, $password);

		if ($found_user_bus_personnel){
			$session->login($found_user_bus_personnel, $object_type_bus_personnel->id);
			redirect_to("index.php");
		} else {
			$session->message("username/password combination is incorrect. ");
		}

	}

} else {
	$username = "";
	$password = "";
}


?>
