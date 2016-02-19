<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-list-buses-for-personnel.php");
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
		        <?php if ($user->role == 1 || $user->role == 4 || $user->role == 5){ ?>
		        <td>&nbsp;</td>
		        <?php } ?>
	        </tr>

        	<?php foreach($buses as $bus){ ?>
        		<tr align="center">
	        		<td><a href="admin_read_update_route.php?routeid=<?php echo $route_object->find_by_id($bus_object->find_by_id($bus->bus_id)->route_id)->id; ?>" class="btn btn-info btn-bloc"><?php echo $route_object->find_by_id($bus_object->find_by_id($bus->bus_id)->route_id)->route_number; ?></a></td>
	        		<td><a href="admin_read_update_bus.php?busid=<?php echo $bus->bus_id; ?>" class="btn btn-warning btn-bloc"><?php echo $bus_object->find_by_id($bus->bus_id)->reg_number; ?></a></td>
	        		<td><?php if (!empty($bus_object->find_by_id($bus->bus_id)->name)) {echo $bus_object->find_by_id($bus->bus_id)->name;} ?></td>
	        		<?php if ($user->role == 1 || $user->role == 4 || $user->role == 5){ ?>
	        		<td><a href="admin_read_update_bus.php?busid=<?php echo $bus->bus_id; ?>" class="btn btn-warning btn-block"><i class="icon-edit icon-white"></i> Edit</a></td>
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
