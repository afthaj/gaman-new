<?php
require_once("./includes/initialize.php");
require_once("./includes/page-scripts/public-read-update-feedback-item.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Feedback &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'feedback_item';?>
      <?php require_once('./includes/layouts/navbar.php');?>

      <!-- Begin page content -->

      <header class="jumbotron subhead">
        <div class="container-fluid">
        	<h1>Feedback</h1>
        </div>
      </header>

      <!-- Start Content -->

      <div class="container-fluid">

        <div class="row-fluid">

       	  <div class="span3">

	       	  <div class="sidenav" data-spy="affix" data-offset-top="200">
		      	<a href="public-list-feedback-items.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Feedback</a>
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

       	  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal">

	            <div class="control-group">
	            <label for="related_object_type" class="control-label">Related to:</label>
					<div class="controls">
					<input type="text" name="related_object_type" disabled="disabled" value="<?php echo $object_type_object->find_by_id($feedback_item_to_read_update->related_object_type)->display_name; ?>" />
					</div>
	            </div>

	            <div class="control-group">
	            <label for="related_object_id" class="control-label">Identifier:</label>
					<div class="controls">
					<input type="text" name="related_object_id" disabled="disabled" value="<?php

					if ($feedback_item_to_read_update->related_object_type == 1){
						//complaint is about a Route
						echo $route_object->find_by_id($feedback_item_to_read_update->related_object_id)->route_number;

					} else if ($feedback_item_to_read_update->related_object_type == 2){
						//complaint is about a Stop
						echo $stop_object->find_by_id($feedback_item_to_read_update->related_object_id)->name;

					} else if ($feedback_item_to_read_update->related_object_type == 3){
						//complaint is about a Bus
						echo $bus_object->find_by_id($feedback_item_to_read_update->related_object_id)->reg_number;

					} else if ($feedback_item_to_read_update->related_object_type == 4){
						//complaint is about a Bus Personnel
						echo $bus_personnel_object->find_by_id($feedback_item_to_read_update->related_object_id)->full_name();

					}
					?>" />
					</div>
	            </div>

	            <div class="control-group">
	            <label for="content" class="control-label">Details of Feedback Item</label>
		            <div class="controls">
		            	<textarea rows="5" name="content"><?php echo $feedback_item_to_read_update->content; ?></textarea>
		            </div>
	            </div>

	          	<div class="form-actions">
	        	    <button class="btn btn-primary" name="submit">Submit</button>
	        	</div>
	        </form>
	        </section>

       	  </div>

	    </div>

      </div>


      <!-- End Content -->



      <div id="push"></div>
    </div>

    <?php require_once('./includes/layouts/footer.php');?>

  </body>
</html>
