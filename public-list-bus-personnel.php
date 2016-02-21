<?php
require_once("./includes/initialize.php");
require_once("./includes/page-scripts/public-list-bus-personnel.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Buses List &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'admin_buses_list';?>
      <?php require_once('./includes/layouts/navbar.php');?>

      <!-- Begin page content -->

      <header class="jumbotron subhead">
        <div class="container-fluid">
          <h1>List of Bus Personnel</h1>
        </div>
      </header>

        <!-- Start Content -->
        <div class="container-fluid">

        <div class="row-fluid">

        <div class="span12">

        <section>

        <table class="table table-bordered table-hover">
	        <tr align="center">
	        	<td>Profile Picture</td>
		        <td>First Name</td>
		        <td>Last Name</td>
		        <td>Role</td>
		        <td>Username</td>
		        <td>NIC Number</td>
		        <td>&nbsp;</td>
	        </tr>

        	<?php foreach($bus_personnel as $bus_person){ ?>
        		<tr align="center">
        			<td>
        			<?php

	        		$bus_personnel_profile_picture = $photo_object->get_profile_picture(4, $bus_person->id);

	        		if (!empty($bus_personnel_profile_picture->filename)) {
	        			echo '<img src="../' . $bus_personnel_profile_picture->image_path() . '" width="100" class="img-rounded" />';
	        		} else {
	        			echo '<img src="img/default-prof-pic.jpg" width="100" class="img-rounded" alt="Please upload a profile picture" />';
	        		}

	        		?>
        			</td>
	        		<td><?php echo $bus_person->first_name; ?></td>
	        		<td><?php echo $bus_person->last_name; ?></td>
	        		<td><?php echo $bus_personnel_role_object->find_by_id($bus_person->role)->role_name; ?></td>
	        		<td><?php echo $bus_person->username; ?></td>
	        		<td><?php echo $bus_person->nic_number; ?></td>
	        		<td><a href="public-read-bus-personnel.php?personnelid=<?php echo $bus_person->id; ?>" class="btn btn-warning btn-block"><i class="icon-info-sign icon-white"></i> View Details</a></td>
        		</tr>
        	<?php }?>

        </table>

        </section>

        </div>

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


      <div id="push"></div>
    </div>

    <?php require_once('./includes/layouts/footer.php');?>

  </body>
</html>
