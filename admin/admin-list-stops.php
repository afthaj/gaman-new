<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-list-stops.php")
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Stops List &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'admin_stops_list';?>
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
		 <div class="container-fluid">
		   <h1>List of Bus Stops</h1>
		 </div>
	  </header>

      <!-- Begin page content -->

      <!-- Start Content -->

      <div class="container-fluid">

      <div class="row-fluid">

      <?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
      <div class="span3">
      	<div class="sidenav" data-spy="affix" data-offset-top="200">
      		<a href="admin-create-stop.php" class="btn btn-primary btn-block"><i class="icon-plus icon-white"></i> Add New Bus Stop</a>
      	</div>
      </div>
      <?php } else { ?>
      <div class="span3">
      	<div class="sidenav" data-spy="affix" data-offset-top="200">
      		<a href="./" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Home</a>
      	</div>
      </div>
      <?php } ?>

      <div class="span9">

      <!-- add in a select/search box to choose the route, so that users can easily choose the stop -->

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

      <section>

      <table class="table table-bordered table-hover">

      <tr>
	   <td rowspan="2" align="center">Stop Name</td>
	   <td colspan="2" align="center">Coordinates</td>
	   <td rowspan="2">&nbsp;</td>
	   <?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	   <td rowspan="2">&nbsp;</td>
	   <?php } ?>
      </tr>

      <tr align="center">
      	<td>Latitude</td>
      	<td>Longitude</td>
      </tr>

      <?php foreach($stops as $stop){ ?>
      <tr>
	  	<td align="left"><?php echo $stop->name; ?></td>
	  	<td align="center"><?php echo $stop->location_latitude; ?></td>
	  	<td align="center"><?php echo $stop->location_longitude; ?></td>
      	<td><a href="admin-read-update_stop.php?stopid=<?php echo $stop->id; ?>" class="btn btn-warning btn-block"><i class="icon-info-sign icon-white"></i> Details</a></td>
	  	<?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	  	<td><a href="admin-delete-stop.php?stopid=<?php echo $stop->id; ?>" class="btn btn-danger btn-block"><i class="icon-remove icon-white"></i> Delete</a></td>
	  	<?php } ?>
      </tr>
      <?php }?>
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
