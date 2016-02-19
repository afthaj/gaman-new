<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-list-buses.php")
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Buses List &middot; <?php echo WEB_APP_NAME; ?></title>
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
          <h1>List of Buses</h1>
        </div>
      </header>

        <!-- Start Content -->
        <div class="container-fluid">

        <?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
        <div class="row-fluid">
        	<br />
	        <a href="admin-create-bus.php" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add New Bus</a>
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
	        <tr align="center">
		        <td>Route Number</td>
		        <td>Registration Number</td>
		        <td>Name (Optional)</td>
		        <td>&nbsp;</td>
		        <?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
		        <td>&nbsp;</td>
		        <?php } ?>
	        </tr>

        	<?php foreach($buses as $bus){ ?>
        		<tr align="center">
	        		<td><?php echo $route_object->find_by_id($bus->route_id)->route_number; ?></td>
	        		<td><?php echo $bus->reg_number; ?></td>
	        		<td><?php if (!empty($bus->name)) {echo $bus->name;} ?></td>
	        		<td><a href="admin-read-update-bus.php?busid=<?php echo $bus->id; ?>" class="btn btn-warning btn-block"><i class="icon-edit icon-white"></i> Edit</a></td>
	        		<?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	        		<td><a href="admin-delete-bus.php?busid=<?php echo $bus->id; ?>" class="btn btn-danger btn-block"><i class="icon-remove icon-white"></i> Delete</a></td>
	        		<?php } ?>
        		</tr>
        	<?php } ?>

        </table>

        </section>

        </div>

        </div>

        </div>
        <!-- End Content -->


      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
