<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-list-complaints.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Complaints List &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'list_complaints';?>
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <header class="jumbotron subhead">
		 <div class="container-fluid">
		   <h1>List of Complaints</h1>
		 </div>
	  </header>

      <!-- Begin page content -->

      <!-- Start Content -->

      <div class="container-fluid">

      	<div class="row-fluid">
	        <br />
	        <div class="well">
		        <a href="admin-create-complaint.php" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add New Complaint</a>
		        <div class="pull-right">
		        	Show for &middot; <a href="#" class="btn btn-info">All</a> &middot; <a href="#" class="btn btn-info">Bus Routes</a> &middot; <a href="#" class="btn btn-info">Bus Stops</a> &middot; <a href="#" class="btn btn-info">Buses</a>
		        </div>
	        </div>
	        <br/>
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

        ?>

        <table class="table table-bordered table-hover">
          <thead>
	        <tr align="center">
		        <td class="span4">Complaint Type</td>
		        <td>Related To</td>
		        <td>Identfier</td>
		        <td>Date Submitted</td>
		        <td>Time Submitted</td>
		        <td>Complaint Details</td>
		        <td>Complaint Status</td>
		        <td>&nbsp;</td>
		        <td>&nbsp;</td>
	        </tr>
	      </thead>
	      <tbody>

        	<?php foreach($complaints as $complaint){ ?>
        		<tr align="center">
	        		<td><?php echo $complaint_type_object->find_by_id($complaint->complaint_type)->comp_type_name; ?></td>
			        <td><?php echo $object_type_object->find_by_id($complaint->related_object_type)->display_name; ?></td>
			        <td>
			        <?php
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
				        	echo $bus_personnel_object->find_by_id($complaint->related_object_id)->full_name();
				        	break;
					}
			        ?>
			        </td>
			        <td><?php echo date("d M Y", $complaint->date_time_submitted); ?></td>
			        <td><?php echo date("h:i:s a", $complaint->date_time_submitted); ?></td>
			        <td><?php echo $complaint->content; ?></td>
			        <td><span class="label
			        <?php

			        if ($complaint_status_object->find_by_id($complaint->status)->id == 1){
			        	echo ' label-info';
			        } else if ($complaint_status_object->find_by_id($complaint->status)->id == 2){
			        	echo ' label-warning';
			        } else if ($complaint_status_object->find_by_id($complaint->status)->id == 3){
			        	echo ' label-success';
			        }

			        ?>
			        "><?php echo $complaint_status_object->find_by_id($complaint->status)->comp_status_name; ?></span></td>
	        		<td><a href="admin-read-update-complaint.php?complaintid=<?php echo $complaint->id; ?>" class="btn btn-warning btn-block"><i class="icon-edit icon-white"></i></a></td>
	        		<td><a href="admin-delete-complaint.php?complaintid=<?php echo $complaint->id; ?>" class="btn btn-danger btn-block"><i class="icon-remove icon-white"></i></a></td>
        		</tr>
        	<?php }?>

          </tbody>
        </table>

        </div>

        <!-- Start Pagination -->

		<?php
		if ($pagination->total_pages() > 1){

			echo '<div class="span12 pagination pagination-centered">';
			echo '<ul>';

			echo $pagination->has_previous_page() ? '<li><a href="' . $_SERVER['PHP_SELF'] . '?page='.$pagination->previous_page().'">&laquo;</a></li>' : '<li class="disabled"><a href="">&laquo;</a></li>';

			for ($i=1; $i <= $pagination->total_pages(); $i++) {

				echo '<li';
				echo $i == $pagination->current_page ? ' class="active"' : '';
				echo '>';
				echo '<a href="' . $_SERVER['PHP_SELF'] . '?page=';
				echo $i;
				echo '">'.$i.'</a>';
				echo '</li>';

			}

			echo $pagination->has_next_page() ? '<li><a href="' . $_SERVER['PHP_SELF'] . '?page='.$pagination->next_page().'">&raquo;</a></li>' : '<li class="disabled"><a href="">&raquo;</a></li>';

			echo '</ul>';
			echo '</div>';
		}
		?>

		<!-- End Pagination -->

      </div>
      <!-- End Content -->

      <div class="clearfix">&nbsp;</div>

      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
