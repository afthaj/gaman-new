<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-read-update-stop.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Route Details &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>

  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
		 <div class="container-fluid">
		   <h1><?php echo $stop_to_read_update->name; ?></h1>
		 </div>
	  </header>

      <!-- Begin page content -->

      <div class="container-fluid">

      <div class="row-fluid">

        <div class="span3">
	        <div class="sidenav" data-spy="affix" data-offset-top="150">
	        	<a href="admin-list-stops.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Stops</a>
	        	<br />
	        	<a href="admin-create-feedback.php" class="btn btn-success btn-block"><i class="icon-thumbs-up icon-white"></i> Give Feedback</a>
	        	<a href="admin-create-complaint.php" class="btn btn-danger btn-block"><i class="icon-exclamation-sign icon-white"></i> Create Complaint</a>
	        	<br />
	        	<div class="well">Feedback <span class="badge badge-success"><?php echo count($feedback_on_stop); ?></span></div>
	        	<div class="well">Complaints <span class="badge badge-important"><?php echo count($complaints_of_stop); ?></span></div>
	        </div>
        </div>

        <!-- Start Content -->

        <div class="span9">

        <section>

        <?php echo $session->message; ?>

        <ul class="nav nav-tabs">
	      <li class="active"><a href="#stop_pictures" data-toggle="tab">Pictures of Bus Stop</a></li>
	      <li><a href="#map_location" data-toggle="tab">Map Location</a></li>
	      <li><a href="#route_profile" data-toggle="tab">Bus Stop Profile</a></li>
	      <li><a href="#route_stops_list" data-toggle="tab">List of Routes</a></li>
	      <li><a href="#feedback" data-toggle="tab">Feedback </a></li>
	      <li><a href="#complaints" data-toggle="tab">Complaints </a></li>
	    </ul>

	    <div id="tab_content" class="tab-content">

	      	<div class="tab-pane fade" id="route_profile">

	      	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?stopid=<?php echo $_GET['stopid']; ?>" method="POST">

	            <div class="control-group">
	            <label for="name" class="control-label">Name of Bus Stop</label>
		            <div class="controls">
		            	<input type="text" name="name"<?php if ($session->object_type != 5){ echo ' class="uneditable-input" id="disabledInput" disabled'; } ?> value="<?php echo $stop_to_read_update->name; ?>" />
		            </div>
	            </div>

	            <?php if (!empty($stop_to_read_update->location_latitude)) { ?>

	            <div class="control-group">
	            <label for="location_latitude" class="control-label">Geo Coordinates:<br />Latitude</label>
		            <div class="controls">
		            	<input type="text" name="location_latitude"<?php if ($session->object_type != 5){ echo ' class="uneditable-input" id="disabledInput" disabled'; } ?> value="<?php echo $stop_to_read_update->location_latitude; ?>" />
		            </div>
	            </div>

	            <div class="control-group">
	            <label for="location_longitude" class="control-label">Geo Coordinates:<br />Longitude</label>
		            <div class="controls">
		            	<input type="text" name="location_longitude"<?php if ($session->object_type != 5){ echo ' class="uneditable-input" id="disabledInput" disabled'; } ?> value="<?php echo $stop_to_read_update->location_longitude; ?>" />
		            </div>
	            </div>

	            <?php } ?>

				<?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
	          	<div class="form-actions">
	        	    <button class="btn btn-primary" name="submit">Submit</button>
	        	</div>
	        	<?php } ?>
	        </form>

	      	</div>

	      	<div class="tab-pane fade" id="route_stops_list">

	      		<div class="clearfix">&nbsp;</div>

	      		<div>
	      			<ul class="bus-stops-list">
	      				<li class=""><h4>Routes that pass through <?php echo $stop_to_read_update->name; ?></h4></li>
	      				<li class="">&nbsp;</li>

	      				<?php for ($i = 0; $i < count($stops_routes); $i++){ ?>

	      				<?php

						$br = new BusRoute();

						$route = $br->find_by_id($stops_routes[$i]->route_id); ?>
			        		<li><a href="admin-read-update-route.php?routeid=<?php echo $route->id; ?>" class="btn btn-info"><?php echo $route->route_number; ?></a> from <a href="admin_read_update_stop.php?stopid=<?php echo BusStop::find_by_id($route->begin_stop)->id; ?>" class="btn btn-info"><?php echo BusStop::find_by_id($route->begin_stop)->name; ?></a> to <a href="admin_read_update_stop.php?stopid=<?php echo BusStop::find_by_id($route->end_stop)->id; ?>" class="btn btn-info"><?php echo BusStop::find_by_id($route->end_stop)->name; ?></a></li>
			        		<li>&nbsp;</li>
		        		<?php } ?>

	      			</ul>
	      		</div>

	   		</div>

			<div class="tab-pane fade" id="map_location">

				<section>
				<?php if (!empty($stop_to_read_update->location_latitude)) { ?>

					<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?q=<?php echo $stop_to_read_update->location_latitude; ?>,<?php echo $stop_to_read_update->location_longitude; ?>&amp;num=1&amp;ie=UTF8&amp;ll=<?php echo $stop_to_read_update->location_latitude; ?>,<?php echo $stop_to_read_update->location_longitude; ?>&amp;t=m&amp;z=17&amp;output=embed"></iframe>
					<br />
					<small>
						<a href="https://www.google.com/maps?q=<?php echo $stop_to_read_update->location_latitude; ?>,<?php echo $stop_to_read_update->location_longitude; ?>&amp;num=1&amp;ie=UTF8&amp;<?php echo $stop_to_read_update->location_latitude; ?>,<?php echo $stop_to_read_update->location_longitude; ?>&amp;spn=0.003105,0.004796&amp;t=m&amp;z=14&amp;source=embed" style="color:#0000FF;text-align:left" target="_blank">View Larger Map</a>
					</small>

				<?php } else {?>
					<h5>Map data currently unavailable</h5>
				<?php } ?>
				</section>

			</div>

			<div class="tab-pane active in" id="stop_pictures">

			<section>

			<?php if (!empty($photos_of_stop)) { ?>

			<div class="callbacks_container">
		        <ul class="rslides" id="responsive_slider">
				    <?php foreach($photos_of_stop as $photo_of_stop) { ?>
					    <li>
							<img src="<?php echo '../../'.$photo_of_stop->image_path(); ?>" alt="">
							<p class="caption"><?php echo PhotoType::find_by_id($photo_of_stop->photo_type)->photo_type_name; ?></p>
						</li>
				    <?php } ?>
				</ul>
	        </div>

			<?php } else { ?>

			<h5>No photos of the Bus Stop have been uploaded yet!</h5>
			<br /><br />
			<?php } ?>

			<?php if ($session->is_logged_in() && $session->object_type == 5) { ?>
			  <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?stopid=<?php echo $_GET['stopid']; ?>" method="POST" enctype="multipart/form-data">
			      <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>

			      <div class="control-group">
			      	<input type="file" name="file_upload" />
			      </div>

			      <div class="control-group">
			      <label for="photo_type" class="control-label">Photo Type</label>
				      <div class="controls">
					      <select name="photo_type">
					      	<?php foreach($photo_types as $photo_type) { ?>
					      	<option value="<?php echo $photo_type->id; ?>"><?php echo $photo_type->photo_type_name; ?></option>
					      	<?php } ?>
					      </select>
				      </div>
			      </div>

			      <div class="form-actions">
			      	<button type="submit" class="btn btn-primary" name="upload">Upload</button>
			      </div>
		      </form>
		    <?php } ?>
		    </section>
			</div>

			<div class="tab-pane fade" id="complaints">
	      	<?php if ($complaints_of_stop) {

	      		foreach ($complaints_of_stop as $complaint) { ?>

	      		<div class="well">
	      			<h4>Complaint Type: <?php echo $complaint_type_object->find_by_id($complaint->complaint_type)->comp_type_name; ?></h4>
	      			<p>Details: <?php echo $complaint->content; ?></p>
	      			<p>Status: <span class="label
			        <?php

			        if ($complaint_status_object->find_by_id($complaint->status)->id == 1){
			        	echo ' label-info';
			        } else if ($complaint_status_object->find_by_id($complaint->status)->id == 2){
			        	echo ' label-warning';
			        } else if ($complaint_status_object->find_by_id($complaint->status)->id == 3){
			        	echo ' label-success';
			        }

			        ?>"><?php echo $complaint_status_object->find_by_id($complaint->status)->comp_status_name; ?></span>
			        </p>
	      			<p>Related to: <span class="badge"><?php echo $object_type_object->find_by_id($complaint->related_object_type)->display_name; ?></span> &middot; Identifier: <span class="badge"><?php
					switch ($complaint->related_object_type) {
					    case 1:
					        echo $route_object->find_by_id($complaint->related_object_id)->route_number;
					        break;
					    case 2:
					        echo $stop_object->find_by_id($complaint->related_object_id)->name;
					        break;
					    case 3:
					        echo $bus_object->find_by_id($complaint->related_object_id)->reg_number;
					        break;
				        case 4:
				        	echo $bus_personnel_object->find_by_id($complaint->related_object_id)->fullname();
				        	break;
					}
			        ?></span> &middot; Submitted on <span class="badge"><?php echo date("d M Y", $complaint->date_time_submitted); ?></span> at <span class="badge"><?php echo date("h:i:s a", $complaint->date_time_submitted); ?></span>
	      			</p>
	      		</div>
	      	<?php }

	      	} else {
	      		echo '<h4>No Complaints have been submitted on this Bus Stop</h4>';
	      	}

	      	?>
	      	</div>

	      	<div class="tab-pane fade" id="feedback">
	      	<?php if ($feedback_on_stop) {

	      		foreach ($feedback_on_stop as $feedback_item) { ?>

	      		<div class="well">
	      			<p><?php echo $feedback_item->content; ?></p>
	      			<p>Submitted on <span class="badge"><?php echo date("d M Y", $feedback_item->date_time_submitted); ?></span> at <span class="badge"><?php echo date("h:i:s a", $feedback_item->date_time_submitted); ?></span>
	      			</p>
	      		</div>
	      	<?php }

	      	} else {
	      		echo '<h4>No Feedback has been submitted on this Bus Stop</h4>';
	      	}

	      	?>
	      	</div>

	    </div>

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
