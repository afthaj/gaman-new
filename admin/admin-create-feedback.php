<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-create-feedback.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Feedback &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>

    <script type="text/javascript">

	function change_related_object_id(str, related_object_id) {

		if (str == "") {
			related_object_id.innerHTML = "";
			return;
			}

		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			request = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				request = new ActiveXObject("Microsoft.XMLHTTP");
				}

		request.onreadystatechange = function() {

			if (request.readyState == 4 && request.status == 200) {
				related_object_id.innerHTML = request.responseText;
				}

			}

		request.open("GET","../ajax-files/get-objects-to-create-feedback.php?q=" + str, true);

		request.send();

		}

	</script>

  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'create_feedback';?>
      <?php require_once('../includes/layouts/navbar-admin.php');?>

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
		      	<a href="admin-list-feedback-items.php" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to List of Feedback Items</a>
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
					<select name="related_object_type" id="related_object_type" onChange="change_related_object_id(this.value, document.getElementById('related_object_id'))">
					<option value="">Please Select</option>
		            	<?php for ($i = 0; $i < count($object_types); $i++){ ?>
							<option value="<?php echo $object_types[$i]->id; ?>"><?php echo $object_types[$i]->display_name; ?></option>
						<?php } ?>
					</select>
					</div>
	            </div>

	            <div class="control-group" id="related_object_id">
	            </div>

		        <input type="hidden" name="status" value="1">

	            <div class="control-group">
	            <label for="content" class="control-label">Feedback Details</label>
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

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
