<?php 


//pagination code
$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$total_count = $complaint_object->count_all();
$pagination = new Pagination($current_page, $per_page, $total_count);

//check user login
if ($session->is_logged_in()){

	if ($session->object_type == 5){
		//admin_user

		$user = $admin_user_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		if (isset($_GET['t'])){
			//time period flag has been set

			$totime = time();

			switch ($_GET['t']) {
				case 1: //past 24 hours
					$fromtime = strtotime("-1 day");
					$complaints = $complaint_object->get_complaints_within_time($fromtime, $totime);
					break;
				case 2: //past 3 days
					$fromtime = strtotime("-3 days");
					$complaints = $complaint_object->get_complaints_within_time($fromtime, $totime);
					break;
				case 3: //past week
					$fromtime = strtotime("-1 week");
					$complaints = $complaint_object->get_complaints_within_time($fromtime, $totime);
					break;
			}
		} else {
			//no time period defined, return ALL the complaints

			$complaints = $complaint_object->get_all();
		}

	} else if ($session->is_logged_in() && $session->object_type == 4){
		//bus_personnel

		$user = $bus_personnel_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture($session->object_type, $user->id);

		$complaints = $complaint_object->get_complaints_for_user($user->id, $session->object_type);

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
