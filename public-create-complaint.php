<?php
require_once("./includes/initialize.php");
require_once("./includes/page-scripts/public-create-complaint.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Complaints &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>

  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'complaints';?>
      <?php require_once('./includes/layouts/navbar.php');?>

      <!-- Begin page content -->

      <header class="jumbotron subhead">
        <div class="container-fluid">
        	<h1>Complaints</h1>
        </div>
      </header>

      <!-- Start Content -->

      <div class="container-fluid">

        <div class="row-fluid">

       	  <div class="span3">

	       	  <div class="sidenav" data-spy="affix" data-offset-top="200">
		      	<a href="public-list-complaints.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Complaints</a>
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
	            <label for="complaint_type" class="control-label">Complaint Type</label>
		            <div class="controls">
		            	<select name="complaint_type" onChange="change_related_object_type_and_id(this.value, document.getElementById('related_object_type'), document.getElementById('related_object_id'))">
		            	<option value="">Please Select</option>
		            	<?php for ($i = 0; $i < count($complaint_types); $i++){ ?>
							<option value="<?php echo $complaint_types[$i]->id; ?>"><?php echo $object_type_object->find_by_id($complaint_types[$i]->related_object_type)->display_name . ' - ' . $complaint_types[$i]->comp_type_name; ?></option>
						<?php } ?>
						</select>
		            </div>
	            </div>

	            <div class="control-group">
	            <label for="related_object_type" class="control-label">Related to:</label>
					<div class="controls">
					<select name="related_object_type" id="related_object_type">
					</select>
					</div>
	            </div>

	            <div class="control-group" id="related_object_id">
	            </div>

		        <input type="hidden" name="status" value="1">

	            <div class="control-group">
	            <label for="content" class="control-label">Details of Complaint</label>
		            <div class="controls">
		            	<textarea rows="5" name="content"></textarea>
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
