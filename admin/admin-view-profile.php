<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-view-profile.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Profile &middot; <?php echo WEB_APP_NAME; ?></title>
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
         if (!empty($profile_picture->filename)) {
         	echo '<img src="../../' . $profile_picture->image_path() . '" width="200" class="img-rounded" />';
         } else {
         	echo '<img src="../assets/img/default-prof-pic.jpg" width="200" class="img-rounded" alt="Please upload a profile picture" />';
         }
         ?>

		 </div>

		 <div class="span9">
		 	<h1><?php echo $user->full_name();?></h1>
		 	<?php if($session->is_logged_in() && $session->object_type == 5) { ?>
		 	<h3><?php echo $admin_level_object->get_admin_level($user->admin_level)->admin_level_name;?></h3>
		 	<?php } else if ($session->is_logged_in() && $session->object_type == 4) { ?>
		 	<h3><?php echo $bus_personnel_role_object->find_by_id($user->role)->role_name;?></h3>
		 	<?php } ?>
		 </div>

		 </div>
	  </header>

      <!-- Begin page content -->

      <div class="container-fluid">

        <!-- Start Content -->

        <div class="row-fluid">

        <div class="span3">
	        <div class="sidenav" data-spy="affix" data-offset-top="200">
	        	<?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	        		<a href="admin-list-admin-users.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Admin Users</a>
	        	<?php } else if ($session->is_logged_in() && $session->object_type == 4) {?>
	        		<a href="index.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Home</a>
	        	<?php } ?>
	        </div>
        </div>

        <div class="span9">

	    <section>

	    <ul class="nav nav-tabs">
	      <li class="active"><a href="#user_details" data-toggle="tab">Profile</a></li>
	      <li><a href="#password_update" data-toggle="tab">Password</a></li>
	      <li><a href="#profile_picture" data-toggle="tab">Profile Picture</a></li>
	    </ul>

	    <div id="myTabContent" class="tab-content">
	      <div class="tab-pane active in" id="user_details">

	      <?php echo $message; ?>

	        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="tab" class="form-horizontal">

	            <div class="control-group">
	            	<label for="username" class="control-label">Username</label>

		            <div class="controls">
		            	<input type="text" name="username" value="<?php echo $user->username; ?>" />
		            </div>
	            </div>

	            <?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	            <div class="control-group">
	            	<label for="admin_level" class="control-label">Admin Level</label>

		            <div class="controls">
			            <select name="admin_level">
			            <?php for ($i = 0; $i < count($admin_levels); $i++) {?>
			            	<option value="<?php echo $admin_levels[$i]->id; ?>"<?php if (!empty($user->admin_level) && $user->admin_level == $admin_levels[$i]->id) echo ' selected = "selected"'; ?>><?php echo $admin_levels[$i]->admin_level_name; ?></option>
			            <?php } ?>
						</select>
		            </div>
	            </div>
	            <?php } else if ($session->is_logged_in() && $session->object_type == 4) {?>
	            <div class="control-group">
	            <label for="role" class="control-label">Role</label>
		            <div class="controls">
		            	<select name="role"<?php if (!($session->is_logged_in() && $session->object_type == 5)){ echo ' disabled';}?>>
		            	<?php foreach($roles as $role){ ?>
		            		<option value="<?php echo $role->id; ?>"<?php if($user->role==$role->id){echo ' selected="selected"';}?>><?php echo $role->role_name; ?></option>
		            	<?php } ?>
						</select>
		            </div>
	            </div>
	            <?php } ?>

	            <div class="control-group">
	            	<label for="first_name" class="control-label">First Name</label>

		            <div class="controls">
		            	<input type="text" name="first_name" value="<?php echo $user->first_name; ?>" />
		            </div>
	            </div>

	            <div class="control-group">
	            	<label for="last_name" class="control-label">Last Name</label>

		            <div class="controls">
		            	<input type="text" name="last_name" value="<?php echo $user->last_name; ?>" />
		            </div>
	            </div>

	            <?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	            <div class="control-group">
	            	<label for="email_address" class="control-label">Email Address</label>
		            <div class="controls">
		            	<input type="text" name="email_address" value="<?php echo $user->email_address; ?>" />
		            </div>
	           </div>
	           <?php } else if ($session->is_logged_in() && $session->object_type == 4) {?>
	           <div class="control-group">
	            	<label for="nic_number" class="control-label">NIC Number</label>
		            <div class="controls">
		            	<input type="text" name="nic_number" value="<?php echo $user->nic_number; ?>" />
		            </div>
	           </div>

	           <div class="control-group">
	            	<label for="telephone_number" class="control-label">Telephone Number</label>
		            <div class="controls">
		            	<input type="text" name="telephone_number" value="<?php echo $user->telephone_number; ?>" />
		            </div>
	           </div>
	            <?php } ?>

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

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
