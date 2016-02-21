<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-create-stop.php");
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
          <h1>Add New Bus Stop</h1>
        </div>
      </header>

        <!-- Start Content -->

        <div class="container-fluid">

        <div class="row-fluid">

        <div class="span3">
	        <div class="sidenav" data-spy="affix" data-offset-top="200">
	        	<a href="admin-list-stops.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Stops List</a>
	        </div>
        </div>


        <div class="span9">

        <section>

        <?php echo $session->message; ?>

        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <div class="control-group">
            <label for="name" class="control-label">Name of Bus Stop</label>
	            <div class="controls">
	            	<input type="text" value="" name="name">
	            </div>
            </div>

            <div class="control-group">
            <label for="location_latitude" class="control-label">Geo Location:<br />Latitude</label>
	            <div class="controls">
	            	<input type="text" value="" name="location_latitude">
	            </div>
            </div>

            <div class="control-group">
            <label for="location_longitude" class="control-label">Geo Location:<br />Longitude</label>
	            <div class="controls">
	            	<input type="text" value="" name="location_longitude">
	            </div>
            </div>

          	<div class="form-actions">
        	    <button class="btn btn-primary" name="submit">Submit</button>
        	</div>
        </form>

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
