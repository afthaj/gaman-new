<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-view-trip-info.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Trip Info &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>

  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
        <div class="container-fluid">
        	<h1>Trip Information</h1>
        	<h3>Started from <?php echo $stop_object->find_by_id($trip_to_read->begin_stop)->name; ?> &middot; Ended at <?php echo $stop_object->find_by_id($trip_to_read->end_stop)->name; ?></h3>
        	<h4>Started at <?php echo strftime("%I:%M:%S %p", $trip_to_read->departure_from_begin_stop); ?> &middot; Ended at <?php echo strftime("%I:%M:%S %p", $trip_to_read->arrival_at_end_stop); ?></h4>
        </div>
      </header>

      <!-- Begin page content -->
      <div class="container-fluid">
      <div class="row-fluid">
        <!-- Start Content -->

        <div class="span3">
        	<div class="sidenav" data-spy="affix" data-offset-top="200">
        		<a href="admin-list-trips.php?surveyid=<?php echo $trip_to_read->survey_id; ?>" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Trips</a>
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

        <?php if ($stop_activities) { ?>

        <table class="table table-bordered table-hover">

	      <tr>
		   <td align="center">Bus Stop</td>
		   <td align="center">Alighted Commuters</td>
		   <td align="center">Boarded Commuters</td>
		   <td align="center">Time Arrived at Stop</td>
		   <td align="center">Time Departed from Stop</td>
	      </tr>

	      <?php foreach($stop_activities as $sa) { ?>
	      <tr>
		   <td align="center"><?php echo $stop_object->find_by_id($sa->stop_id)->name; ?></td>
		   <td align="center"><?php echo $sa->alighted_commuters; ?></td>
		   <td align="center"><?php echo $sa->boarded_commuters; ?></td>
		   <td align="center"><?php if (!empty($sa->arrival_time)) { echo strftime("%I:%M:%S %p", $sa->arrival_time); } else {echo '0'; } ?></td>
		   <td align="center"><?php if (!empty($sa->departure_time)) { echo strftime("%I:%M:%S %p", $sa->departure_time);  } else {echo '0'; } ?></td>
	      </tr>
	      <?php } ?>

	    </table>

	    <?php } else { ?>
	      <div class="alert">
	      No Stop Activities recorded
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      </div>
      	<?php } ?>

        </section>

        <div class="row-fluid">
	       	<section>
	       	<div id="chart_line" style="width: 100%;"></div>
	       	</section>
       	</div>

        <div class="row-fluid">
	       	<section>
	       	<div id="chart_column" style="width: 100%;"></div>
	       	</section>
       	</div>

        <div class="row-fluid">
          <section>
          <div id="chart_pie" style="width: 100%;"></div>
          </section>
        </div>

        <div class="row-fluid">
	       	<section>
	       	<div id="myPieChart" style="width: 100%;"></div>
	       	</section>
       	</div>

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
