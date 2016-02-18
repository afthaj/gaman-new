<?php
require_once("./includes/initialize.php");

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
				redirect_to('public_view_profile.php');
			} else {
				$session->message("Error! Your details could not be updated. ");
			}
		}

		if (isset($_POST['update'])){

			if ($_POST['old_password'] == $user->password){

				$user->password = $_POST['new_password'];

				if ($admin_user->update()){
					$session->message("Success! The password was updated. ");
					redirect_to('public_view_profile.php');
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
				redirect_to('public_view_profile.php');
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Profile &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php require_once('./includes/layouts/navbar.php');?>

      <header class="jumbotron subhead">
		 <div class="container-fluid">

		 <div class="span3">
		 <?php
		 	if (!empty($profile_picture->filename)) {
		 		echo '<img src="../' . $profile_picture->image_path() . '" width="200" class="img-rounded" />';
		 	} else {
		 		echo '<img src="img/default-prof-pic.jpg" width="200" class="img-rounded" alt="Please upload a profile picture" />';
		 	}
		 ?>
		 </div>

		 <div class="span9">
		   <h1><?php echo $user->full_name(); ?></h1>
		   <h3>User profile</h3>
		 </div>

		 </div>
	  </header>

      <!-- Begin page content -->

      <div class="container-fluid">

        <!-- Start Content -->

        <div class="row-fluid">

        <div class="span3">
	        <div class="sidenav" data-spy="affix" data-offset-top="300">
	        	<a href="index.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Home Page</a>
	        	<a href="public_list_feedback_items.php" class="btn btn-success btn-block"><i class="icon-thumbs-up icon-white"></i> View Feedback Given</a>
	        	<a href="public_list_complaints.php" class="btn btn-danger btn-block"><i class="icon-exclamation-sign icon-white"></i> View Complaints Submitted</a>
	        </div>
        </div>

        <div class="span9">

	    <section>

	    <?php

        if(!empty($session->message)){

        	echo '<div class="alert">';
        	echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        	//echo '<p>';
        	echo $session->message;
        	//echo '</p>';
        	echo '</div>';
        }

        ?>

	    <ul class="nav nav-tabs">
	      <li class="active"><a href="#user_details" data-toggle="tab">Profile</a></li>
	      <li><a href="#password_update" data-toggle="tab">Password</a></li>
	      <li><a href="#profile_picture" data-toggle="tab">Profile Picture</a></li>
	    </ul>

	    <div id="myTabContent" class="tab-content">
	      <div class="tab-pane active in" id="user_details">

	        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="tab" class="form-horizontal">

	            <div class="control-group">
	            	<label for="username" class="control-label">Username</label>

		            <div class="controls">
		            	<input type="text" value="<?php echo $user->username; ?>" name="username">
		            </div>
	            </div>

	            <div class="control-group">
	            	<label for="first_name" class="control-label">First Name</label>

		            <div class="controls">
		            	<input type="text" value="<?php echo $user->first_name; ?>" name="first_name">
		            </div>
	            </div>

	            <div class="control-group">
	            	<label for="last_name" class="control-label">Last Name</label>

		            <div class="controls">
		            	<input type="text" value="<?php echo $user->last_name; ?>" name="last_name">
		            </div>
	            </div>

	            <div class="control-group">
	            	<label for="email_address" class="control-label">Email Address</label>

		            <div class="controls">
		            	<input type="text" value="<?php echo $user->email_address; ?>" name="email_address">
		            </div>
	           </div>

	          	<div class="form-actions">
        	    	<button class="btn btn-primary" name="submit">Submit</button>
	        	</div>
	        </form>

	      </div>

	      <div class="tab-pane fade" id="password_update">

	    	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="tab" class="form-horizontal">
	    		<div class="control-group">
	        		<label for="old_password" class="control-label">Old Password</label>

		        	<div class="controls">
		        		<input type="password" name="old_password">
		        	</div>
	        	</div>

	    		<div class="control-group">
	        		<label for="new_password" class="control-label">New Password</label>

		        	<div class="controls">
		        		<input type="password" name="new_password">
		        	</div>
	        	</div>

	        	<div class="form-actions">
	        	    <button class="btn btn-primary" name="update">Update</button>
	        	</div>

	    	</form>
	      </div>

	      <div class="tab-pane fade" id="profile_picture">

		  <?php
          if (!empty($profile_picture->filename)) {
          	echo '<h5>You have already uploaded a Profile Picture</h5>';
          	echo '<a href="#" class="btn btn-danger"/>Delete and Reupload</a>';
          } else {
          ?>
		  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		      <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>

		      <div class="control-group">
		      	<input type="file" name="file_upload" />
		      </div>

		      <div class="form-actions">
		      	<button type="submit" class="btn btn-primary" name="upload">Upload</button>
		      </div>
	      </form>
	      <?php } ?>

	      </div>

	  	  </div>

	  	</section>

	  	</div>

	  	</div>

        <!-- End Content -->

      </div>

      <div class="clearfix">&nbsp;</div>

      <div id="push"></div>
    </div>

    <?php require_once('./includes/layouts/footer_admin.php');?>

    <?php require_once('./includes/layouts/scripts_admin.php');?>

  </body>
</html>
