<?php


//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

	} else {
		$session->message("Error! You must login to view the requested page. ");
		redirect_to("login.php");
	}

	//GET request stuff
	if (!empty($_GET['routeid'])){

		$route = $route_object->find_by_id($_GET['routeid']);
		$surveys = $survey_object->get_surveys_for_route($route->id);

	} else {

		$surveys = $survey_object->find_all();

		//$session->message("No Route ID provided to view.");
		//redirect_to("admin_list_routes.php");
	}

} else {
	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}


?>
