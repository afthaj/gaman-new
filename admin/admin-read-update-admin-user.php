<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-read-update-admin-user.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Profile &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
		 <div class="container-fluid">

		 <div class="span3">

		 <?php
         if (!empty($profile_picture_of_other_admin_users->filename)) {
         	echo '<img src="../../' . $profile_picture_of_other_admin_users->image_path() . '" width="200" class="img-rounded" />';
         } else {
         	echo '<img src="../assets/img/default-prof-pic.jpg" width="200" class="img-rounded" alt="Please upload a profile picture" />';
         }
         ?>

		 </div>

		 <div class="span9">
		 	<h1>Admin Profile</h1>
		 	<h3><?php echo $user_to_read_update->full_name(); ?></h3>
		 </div>

		 </div>
	  </header>

      <!-- Begin page content -->

      <div class="container-fluid">

      <div class="row-fluid">

        <div class="span3">
	        <div class="sidenav" data-spy="affix" data-offset-top="200">
	          <a href="admin-list-admin-users.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Admin Users</a>
	        </div>
        </div>

        <!-- Start Content -->

        <div class="span9">

	    <section>

	    <?php echo $session->message; ?>

	    <ul class="nav nav-tabs">
	      <li class="active"><a href="#user_details" data-toggle="tab">Profile</a></li>
	      <li><a href="#password_update" data-toggle="tab">Password</a></li>
	      <li><a href="#profile_picture" data-toggle="tab">Profile Picture</a></li>
	    </ul>

	    <div id="myTabContent" class="tab-content">
	      <div class="tab-pane active in" id="user_details">
	        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?adminid=<?php echo $_GET['adminid']; ?>" method="POST" id="tab">

	            <div class="control-group">
	            <label for="username" class="control-label">Username</label>
		            <div class="controls">
		            	<input type="text" value="<?php echo $user_to_read_update->username; ?>" name="username">
		            </div>
	            </div>

	            <div class="control-group">
	            <label for="admin_level" class="control-label">Admin Level</label>
		            <div class="controls">
			            <select name="admin_level">
			            <?php for ($i = 0; $i < count($admin_levels); $i++) {?>
			            	<option value="<?php echo $admin_levels[$i]->id; ?>"<?php if (!empty($user_to_read_update->admin_level) && $user_to_read_update->admin_level == $admin_levels[$i]->id) echo ' selected = "selected"'; ?>><?php echo $admin_levels[$i]->admin_level_name; ?></option>
			            <?php } ?>
						</select>
					</div>
	            </div>

	            <div class="control-group">
	            <label for="first_name" class="control-label">First Name</label>
		            <div class="controls">
		            	<input type="text" value="<?php echo $user_to_read_update->first_name; ?>" name="first_name">
		            </div>
	            </div>

	            <div class="control-group">
	            <label for="last_name" class="control-label">Last Name</label>
		            <div class="controls">
		            	<input type="text" value="<?php echo $user_to_read_update->last_name; ?>" name="last_name">
		            </div>
	            </div>

	            <div class="control-group">
	            <label for="email_address" class="control-label">Email Address</label>
		            <div class="controls">
		            	<input type="text" value="<?php echo $user_to_read_update->email_address; ?>" name="email_address">
		            </div>
	            </div>

	          	<div class="form-actions">
	        	    <button class="btn btn-primary" name="submit">Submit</button>
	        	</div>
	        </form>
	      </div>

	      <div class="tab-pane fade" id="password_update">
	    	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?adminid=<?php echo $_GET['adminid']; ?>" method="POST" id="tab2">

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
          if (!empty($profile_picture_of_other_admin_users->filename)) {
          	echo '<h5>This User already has a Profile Picture uploaded</h5>';
          	echo '<a href="#" class="btn btn-danger"/>Delete and Reupload</a>';
          } else {
          ?>

		  <form action="<?php echo $_SERVER['PHP_SELF']; ?>?adminid=<?php echo $_GET['adminid']; ?>" method="POST" enctype="multipart/form-data">
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

      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
