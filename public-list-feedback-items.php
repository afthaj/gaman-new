<?php
require_once("./includes/initialize.php");
require_once("./includes/page-scripts/public-list-feedback-items.php");
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
      <?php $page = 'list_feedback_items';?>
      <?php require_once('./includes/layouts/navbar.php');?>

      <header class="jumbotron subhead">
		 <div class="container-fluid">
		   <h1>Feedback Provided</h1>
		 </div>
	  </header>

      <!-- Begin page content -->

      <!-- Start Content -->

      <div class="container-fluid">

      	<div class="row-fluid">
	        <br />
	        <a href="public-create-feedback.php" class="btn btn-primary"><i class="icon-plus icon-white"></i> Provide Feedback</a>
	        <br/> <br />
        </div>

        <div class="row-fluid">

        <?php

	        if(!empty($session->message)){

	        	echo '<div class="alert">';
	        	echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	        	//echo '<p>';
	        	echo $session->message;
	        	//echo '</p>';
	        	echo '</div>';
	        }

	        if ($feedback_items) {
		?>

        <table class="table table-bordered table-hover">
          <thead>
	        <tr align="center">
		        <td>Related To</td>
		        <td>Identifier</td>
		        <td>Date Submitted</td>
		        <td>Time Submitted</td>
		        <td>Feedback Details</td>
		        <td>&nbsp;</td>
	        </tr>
	      </thead>
	      <tbody>

        	<?php foreach($feedback_items as $feedback_item){ ?>
        		<tr align="center">
			        <td><?php echo $object_type_object->find_by_id($feedback_item->related_object_type)->display_name; ?></td>
			        <td>
			        <?php
					switch ($feedback_item->related_object_type) {
					    case 1:
					        echo $route_object->find_by_id($feedback_item->related_object_id)->route_number;
					        break;
					    case 2:
					        echo $stop_object->find_by_id($feedback_item->related_object_id)->name;
					        break;
					    case 3:
					        echo $bus_object->find_by_id($feedback_item->related_object_id)->reg_number;
					        break;
				        case 4:
				        	echo $bus_personnel_object->find_by_id($feedback_item->related_object_id)->full_name();
				        	break;
					}
			        ?>
			        </td>
			        <td><?php echo date("d M Y", $feedback_item->date_time_submitted); ?></td>
			        <td><?php echo date("h:i:s a", $feedback_item->date_time_submitted); ?></td>
			        <td><?php echo $feedback_item->content; ?></td>
	        		<td><a href="public-read-update-feedback-item.php?feedbackitemid=<?php echo $feedback_item->id; ?>" class="btn btn-warning btn-block"><i class="icon-edit icon-white"></i></a></td>
        		</tr>
        	<?php } ?>

          </tbody>
        </table>
        <?php

	        } else {
	        	echo '<h4>You have not provided any Feedback yet. </h4>';
	        }

        ?>

        </div>

      </div>
      <!-- End Content -->

      <div class="clearfix">&nbsp;</div>

      <div id="push"></div>
    </div>

    <?php require_once('./includes/layouts/footer.php');?>

  </body>
</html>
