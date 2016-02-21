<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-create-bus-personnel.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add New Bus Personnel &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <!-- Begin page content -->

      <header class="jumbotron subhead">
        <div class="container-fluid">
          <h1>Add New Bus Personnel</h1>
        </div>
      </header>

      <div class="container-fluid">

      <div class="row-fluid">

        <!-- Start Content -->

        <div class="span3">
        	<div class="sidenav" data-spy="affix" data-offset-top="200">
        		<a href="admin-list-bus-personnel.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Personnel List</a>
        	</div>
        </div>

        <div class="span9">

        <section>

        <?php echo $session->message; ?>

        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <div class="control-group">
            <label for="role" class="control-label">Role of Person</label>
	            <div class="controls">
	            	<select name="role">
	            	<?php foreach($roles as $role){ ?>
	            		<option value="<?php echo $role->id; ?>"><?php echo $role->role_name; ?></option>
	            	<?php } ?>
					</select>
	            </div>
            </div>

            <div class="control-group">
        	<label for="username" class="control-label">Username</label>
	        	<div class="controls">
	        		<input type="text" name="username" />
	        	</div>
        	</div>

        	<div class="control-group">
        	<label for="password" class="control-label">Password</label>
	        	<div class="controls">
	        		<input type="password" name="password" />
	        	</div>
        	</div>

            <div class="control-group">
        	<label for="first_name" class="control-label">First Name</label>
	        	<div class="controls">
	        		<input type="text" name="first_name" />
	        	</div>
        	</div>

            <div class="control-group">
            <label for="last_name" class="control-label">Last Name</label>
	            <div class="controls">
	            	<input type="text" value="" name="last_name" />
	            </div>
            </div>

            <div class="control-group">
            <label for="nic_number" class="control-label">NIC Number</label>
	            <div class="controls">
	            	<input type="text" value="" name="nic_number" />
	            </div>
            </div>

            <!--
            <div class="control-group">
            <label for="bus_id" class="control-label">Assigned Bus</label>
	            <div class="controls">
	            	<select name="bus_id">
	            	<?php foreach($buses as $bus){ ?>
	            		<option value="<?php echo $bus->id; ?>"><?php echo $route_object->find_by_id($bus->route_id)->route_number; ?> &middot; <?php echo $bus->reg_number; ?><?php if(!empty($bus->name)){ echo ' &middot; ' . $bus->name;} ?></option>
	            	<?php } ?>
					</select>
	            </div>
            </div>
            -->

          	<div class="form-actions">
        	    <button class="btn btn-primary" name="submit">Submit</button>
        	</div>
        </form>

        </section>

	  	</div>

        <!-- End Content -->

        </div>

        </div>

      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
