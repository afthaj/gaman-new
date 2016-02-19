<?php
require_once("./includes/initialize.php");

//init code
$routes = BusRoute::find_all();
$stops = BusStop::find_all();
$buses = Bus::find_all();
$bus_personnel = BusPersonnel::find_all();

$object_types = $object_type_object->get_main_object_types();

//check login
if ($session->is_logged_in()){

	if ($session->object_type == 6) {
		//commuter

		$user = $commuter_object->find_by_id($_SESSION['id']);
		$profile_picture = $photo_object->get_profile_picture(6, $user->id);

		if (isset($_POST['submit'])){
			$feedback_item_to_create = new FeedbackItem();

			$feedback_item_to_create->bus_route_id = $_POST['bus_route_id'];
			$feedback_item_to_create->stop_id = $_POST['stop_id'];
			$feedback_item_to_create->bus_id = $_POST['bus_id'];
			$feedback_item_to_create->bus_personnel_id = $_POST['bus_personnel_id'];
			$feedback_item_to_create->content = $_POST['content'];

			if (isset($_POST['bus_route_id'])) {

				$feedback_item_to_create->related_object_type = 1;
				$feedback_item_to_create->related_object_id = $_POST['bus_route_id'];

			} else if (isset($_POST['stop_id'])) {

				$feedback_item_to_create->related_object_type = 2;
				$feedback_item_to_create->related_object_id = $_POST['stop_id'];

			} else if (isset($_POST['bus_id'])) {

				$feedback_item_to_create->related_object_type = 3;
				$feedback_item_to_create->related_object_id = $_POST['bus_id'];

			} else if (isset($_POST['bus_personnel_id'])) {

				$feedback_item_to_create->related_object_type = 4;
				$feedback_item_to_create->related_object_id = $_POST['bus_personnel_id'];

			}

			$feedback_item_to_create->user_object_type = $session->object_type;
			$feedback_item_to_create->user_id = $user->id;
			$feedback_item_to_create->date_time_submitted = time();
			$feedback_item_to_create->content = $_POST['content'];

			if ($feedback_item_to_create->create()){
				$session->message("Success! The Complaint has been submitted. ");
				redirect_to('public-list-feedback-items.php');
			} else {
				$session->message("Error! The Feedback could not be submitted. ");
			}

		}

	} else {
		//everyone else

		$session->message("Error! You do not have sufficient priviledges to view the requested page. ");
		redirect_to("index.php");
	}

} else {
	//not logged in... GTFO!

	$session->message("Error! You must login to view the requested page. ");
	redirect_to("login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Feedback &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>

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

		request.open("GET","ajax-files/get-objects-to-create-feedback.php?q=" + str, true);

		request.send();

		}

	</script>

  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'create_feedback';?>
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

    <?php require_once('./includes/layouts/footer.php');?>

    <?php require_once('./includes/layouts/scripts.php');?>

  </body>
</html>
