<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-list-surveys.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Surveys &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
        <div class="container-fluid">
        	<h1>List of Surveys</h1>
        	<?php if (!empty($_GET['routeid'])) { ?>
        	<h3>Route Number: <?php echo $route->route_number;?></h3>
        	<?php } ?>
        </div>
      </header>

      <!-- Begin page content -->
      <div class="container-fluid">
      <div class="row-fluid">
        <!-- Start Content -->

        <div class="span3">
        	<div class="sidenav" data-spy="affix" data-offset-top="200">
        	<?php if (!empty($_GET['routeid'])) { ?>
        		<a href="admin-list-routes.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Routes</a>
        	<?php } else { ?>
        		<a href="index.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Home Page</a>
        	<?php } ?>
        	</div>
        </div>

        <div class="span9">

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

        <?php if ($surveys) { ?>

        <table class="table table-bordered table-hover">

	      <tr>
		   <td align="center">Survey Start Date</td>
		   <td align="center">Survey End Date</td>
		   <td>&nbsp;</td>
	      </tr>

	      <?php foreach($surveys as $survey) { ?>
	      <tr>
		   <td align="center"><?php echo strftime("%B %d, %Y", $survey->start_date); ?></td>
		   <td align="center"><?php echo strftime("%B %d, %Y", $survey->end_date); ?></td>
		   <td><a href="admin-list-trips.php?surveyid=<?php echo $survey->id; ?>" class="btn btn-warning btn-block"><i class="icon-info-sign icon-white"></i> Details</a></td>
	      </tr>
	      <?php } ?>

	    </table>

	    <?php } else { ?>
	      <div class="alert">
	      No Surveys recorded
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      </div>
      	<?php } ?>

        </section>

        </div>

        <!-- End Content -->
      </div>
      </div>
      <!-- End page content -->

      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
