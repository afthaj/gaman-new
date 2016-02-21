<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-create-route.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Bus Route &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
        <div class="container-fluid">
        	<h1>Add New Bus Route</h1>
        </div>
      </header>


      <!-- Begin page content -->

      <div class="container-fluid">

      <div class="row-fluid">

        <!-- Start Content -->

        <div class="span3">
        	<div class="sidenav" data-spy="affix" data-offset-top="200">
        		<a href="admin-list-routes.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Routes</a>
        	</div>
        </div>

        <div class="span9">

        <section>

        <?php echo $session->message; ?>

        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <div class="control-group">
            <label for="route_number" class="control-label">Route Number</label>
	            <div class="controls">
	            	<input type="text" value="" name="route_number">
	            </div>
            </div>

            <div class="control-group">
        	<label for="length" class="control-label">Length</label>
	        	<div class="controls">
	        		<input type="text" name="length">
	        	</div>
        	</div>

            <div class="control-group">
            <label for="trip_time" class="control-label">Trip Time</label>
	            <div class="controls">
	            	<input type="text" value="" name="trip_time">
	            </div>
            </div>

            <div class="control-group">
            <label for="begin_stop" class="control-label">Begin Stop</label>
            <div class="controls">
	            <select name="begin_stop">
	            <?php
	            foreach($stops as $stop){
	            ?>
	            	<option value="<?php echo $stop->name; ?>"><?php echo $stop->name; ?></option>
	            <?php
	            }
	            ?>
				</select>
	            </div>
            </div>

            <div class="control-group">
            <label for="end_stop" class="control-label">End Stop</label>
	            <div class="controls">
		            <select name="end_stop">
		            <?php
		            foreach($stops as $stop){
		            ?>
		            	<option value="<?php echo $stop->name; ?>"><?php echo $stop->name; ?></option>
		            <?php
		            }
		            ?>
					</select>
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

        <!-- End page content -->


      <div class="clearfix">&nbsp;</div>

      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
