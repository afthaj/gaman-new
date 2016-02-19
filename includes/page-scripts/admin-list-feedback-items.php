<?php


//check login
if ($session->is_logged_in()){

	if ($session->object_type == 5) {
		//admin

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_GET['t'])){
			//time period flag has been set
			switch ($_GET['t']) {
				case 1: //past 24 hours
					$fromtime = strtotime("-1 day");
					$totime = time();
					$feedback_items = $feedback_item_object->get_feedback_items_within_time($fromtime, $totime);
					break;
				case 2: //past 3 days
					$fromtime = strtotime("-3 days");
					$totime = time();
					$feedback_items = $feedback_item_object->get_feedback_items_within_time($fromtime, $totime);
					break;
				case 3: //past week
					$fromtime = strtotime("-1 week");
					$totime = time();
					$feedback_items = $feedback_item_object->get_feedback_items_within_time($fromtime, $totime);
					break;

			}

		} else {
			//no time period defined, return ALL the feedback items

			$feedback_items = $feedback_item_object->get_all();
		}



	} else if ($session->is_logged_in() && $session->object_type == 4){
		//bus_personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		$feedback_items = $feedback_item_object->get_feedback_items_for_user($user->id, $session->object_type);

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
