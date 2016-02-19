<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-index.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Home &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>

  </head>

  <body>

    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'index';?>
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      	<div class="jumbotron masthead">
		  <div class="container">
		    <h1><?php echo WEB_APP_NAME; ?></h1>
		    <p><?php echo WEB_APP_CATCH_PHRASE; ?></p>
		  </div>
		</div>

      <!-- Begin page content -->
      <div class="container">

        <!-- Start Content -->

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

        <div class="marketing">

        <div class="row-fluid">

        <?php if ($session->object_type == 5) { //admin_user ?>
        <div class="span6">
	        <h2>Feedback</h2>
	        <div class="well">
	        	<table class="table table-bordered table-hover">

		        	<tbody>
		        		<tr>
		        			<td colspan="3"><h3>For all Entities</h3></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 24 hours</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items1); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=1" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 3 days</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items2); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=2" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past week</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items3); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=3" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td colspan="3"><h3>Bus Routes</h3></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 24 hours</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items1); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=1" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 3 days</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items2); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=2" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past week</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items3); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=3" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td colspan="3"><h3>Bus Stops</h3></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 24 hours</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items1); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=1" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 3 days</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items2); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=2" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past week</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items3); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=3" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td colspan="3"><h3>Buses</h3></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 24 hours</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items1); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=1" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past 3 days</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items2); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=2" class="btn btn-success">View</a></td>
		        		</tr>
		        		<tr>
		        			<td align="right">Past week</td>
		        			<td align="center"><span class="badge badge-success"><?php echo count($feedback_items3); ?></span></td>
		        			<td align="center"><a href="admin-list-feedback-items.php?t=3" class="btn btn-success">View</a></td>
		        		</tr>
		        	</tbody>

	        	</table>
	        </div>
        </div>

        <div class="span6">
	        <h2>Complaints</h2>
	        <div class="well">
		        <table class="table table-bordered table-hover">

			        	<tbody>
				        	<tr>
			        			<td colspan="3"><h3>For all Entities</h3></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 24 hours</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints1); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=1" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 3 days</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints2); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=2" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past week</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints3); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=3" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td colspan="3"><h3>Bus Routes</h3></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 24 hours</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints1); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=1" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 3 days</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints2); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=2" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past week</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints3); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=3" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td colspan="3"><h3>Bus Stops</h3></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 24 hours</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints1); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=1" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 3 days</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints2); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=2" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past week</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints3); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=3" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td colspan="3"><h3>Buses</h3></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 24 hours</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints1); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=1" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past 3 days</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints2); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=2" class="btn btn-danger">View</a></td>
			        		</tr>
			        		<tr>
			        			<td align="right">Past week</td>
			        			<td align="center"><span class="badge badge-important"><?php echo count($complaints3); ?></span></td>
			        			<td align="center"><a href="admin-list-complaints.php?t=3" class="btn btn-danger">View</a></td>
			        		</tr>
			        	</tbody>

		        	</table>
	        </div>
        </div>
        <?php } else if ($session->object_type == 4) { //bus_personnel ?>



        <?php } ?>


        </div>

        </div>
        <!-- End Content -->

      </div>

      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
