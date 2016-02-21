<?php

if (isset($_POST['submit'])){
	$object_type = 6; // for 'commuter' object_type
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$commuter = new Commuter();
	$found_user = $commuter->authenticate($username, $password);
	if ($found_user){
		$session->login($found_user, $object_type);
		redirect_to("./");
	} else {
		$session->message("username/password combination is incorrect. ");
		redirect_to("login.php");
	}
} else {
	$username = "";
	$password = "";
}

?>
