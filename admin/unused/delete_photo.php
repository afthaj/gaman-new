<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){
	redirect_to("login.php");
} else {
	$user = User::find_by_id($_SESSION['user_id']);
}

if (empty($_GET['id'])){
	$session->message("Eror. No photograph ID was provided. ");
	redirect_to("index.php");
}

$photo = Photograph::find_by_id($_GET['id']);

if ($photo && $photo->destroy()){
	$session->message("Success! The {$photo->filename} was deleted. ");
	redirect_to("list_photos.php");
} else {
	$session->message("Error. The photo could not be deleted. ");
	redirect_to("list_photos.php");
}

?>
