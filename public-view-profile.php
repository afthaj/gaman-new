<?php
require_once("./includes/initialize.php");
require_once("./includes/page-scripts/public-view-profile.php");
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
		 		echo '<img src="assets/img/default-prof-pic.jpg" width="200" class="img-rounded" alt="Please upload a profile picture" />';
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
	        	<a href="./" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Home Page</a>
	        	<a href="public-list-feedback-items.php" class="btn btn-success btn-block"><i class="icon-thumbs-up icon-white"></i> View Feedback Given</a>
	        	<a href="public-list-complaints.php" class="btn btn-danger btn-block"><i class="icon-exclamation-sign icon-white"></i> View Complaints Submitted</a>
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

    <?php require_once('./includes/layouts/footer.php');?>

  </body>
</html>
