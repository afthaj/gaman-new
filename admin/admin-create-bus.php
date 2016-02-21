<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-create-bus.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Bus Stop &middot; <?php echo WEB_APP_NAME; ?></title>
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
          <h1>Add New Bus</h1>
        </div>
      </header>

      <div class="container-fluid">

      <div class="row-fluid">

        <!-- Start Content -->

        <div class="span3">
        	<div class="sidenav" data-spy="affix" data-offset-top="200">
        		<a href="admin-list-buses.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Buses</a>
        	</div>
        </div>

        <div class="span9">

        <section>

        <?php echo $session->message; ?>

        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <div class="control-group">
            <label for="route_id" class="control-label">Route Number</label>
	            <div class="controls">
	            	<select name="route_id">
					<?php foreach($routes as $route){ ?>
	            		<option value="<?php echo $route->id; ?>"><?php echo $route->route_number; ?></option>
	            	<?php } ?>
					</select>
	            </div>
            </div>

            <div class="control-group">
        	<label for="reg_number" class="control-label">Registration Number</label>
	        	<div class="controls">
	        		<input type="text" name="reg_number">
	        	</div>
        	</div>

            <div class="control-group">
            <label for="name" class="control-label">Name of Bus</label>
	            <div class="controls">
	            	<input type="text" value="" name="name">
	            </div>
            </div>

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
