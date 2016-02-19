<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-list-routes.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Routes List &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'admin_routes_list';?>
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
		 <div class="container-fluid">
		   <h1>List of Bus Routes</h1>
		 </div>
	  </header>

      <!-- Begin page content -->

      <!-- Start Content -->

      <div class="container-fluid">

      	<?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
      	<div class="row-fluid">
	        <br />
	        <a href="admin-create-route.php" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add New Route</a>
	        <br />
        </div>
        <?php } ?>

        <div class="row-fluid">

        <div class="span12">

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

        <table class="table table-bordered table-hover">
          <thead>
	        <tr align="center">
		        <td>Route Number</td>
		        <td>Begin Stop</td>
		        <td>End Stop</td>
		        <td>Length (km)</td>
		        <td>Trip Time</td>
		        <td>&nbsp;</td>
		        <?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
		        <td>&nbsp;</td>
		        <td>&nbsp;</td>
		        <?php } ?>
	        </tr>
	      </thead>
	      <tbody>

        	<?php foreach($routes as $route){ ?>
        		<tr align="center">
	        		<td><?php echo $route->route_number; ?></td>
	        		<td><?php echo $stop_object->find_by_id($route->begin_stop)->name; ?></td>
	        		<td><?php echo $stop_object->find_by_id($route->end_stop)->name; ?></td>
	        		<td><?php echo $route->length; ?></td>
	        		<td><?php echo $route->trip_time; ?></td>
	        		<td><a href="admin-read-update-route.php?routeid=<?php echo $route->id; ?>" class="btn btn-warning btn-block"><i class="icon-info-sign icon-white"></i> Route Profile</a></td>
	        		<?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	        		<td><a href="admin-list-surveys.php?routeid=<?php echo $route->id; ?>" class="btn btn-success btn-block"><i class="icon-globe icon-white"></i> Survey Data</a></td>
	        		<td><a href="admin-delete-route.php?routeid=<?php echo $route->id; ?>" class="btn btn-danger btn-block"><i class="icon-remove icon-white"></i> Delete</a></td>
	        		<?php } ?>
        		</tr>
        	<?php } ?>

          </tbody>

        </table>

        </section>

        </div>

        </div>

      </div>
      <!-- End Content -->

      <div class="clearfix">&nbsp;</div>

      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
