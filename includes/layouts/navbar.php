<div class="navbar navbar-fixed-top navbar-invers">
  <div class="navbar-inner">
    <div class="container-fluid">

      <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <!-- <a class="brand" href="./"><?php echo WEB_APP_NAME;?></a> -->

      <div class="nav-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
          <li<?php if (!empty($page) && $page == 'index'){echo ' class="active"';}?>><a href="./"><i class="icon-home icon-white"></i></a></li>

          <li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bus Routes &amp; Stops <b class="caret"></b></a>
          	<ul class="dropdown-menu">
          		<li><a href="public_list_routes.php"><i class="icon-info-sign icon-white"></i> View All Bus Routes</a></li>
          		<!-- <li><a href="#"><i class="icon-search icon-white"></i> Search for Bus Route</a></li> -->
          		<li class="divider"></li>
          		<li><a href="public_list_stops.php"><i class="icon-info-sign icon-white"></i> View All Stops</a></li>
          		<!-- <li><a href="#"><i class="icon-search icon-white"></i> Search for Bus Stop</a></li> -->
          	</ul>
          </li>

          <li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Buses &amp; Personnel <b class="caret"></b></a>
          	<ul class="dropdown-menu">
          		<li><a href="public_list_buses.php"><i class="icon-info-sign icon-white"></i> View All Buses</a></li>
          		<!-- <li><a href="#"><i class="icon-search icon-white"></i> Search for Bus</a></li> -->
          		<li class="divider"></li>
          		<li><a href="public_list_bus_personnel.php"><i class="icon-info-sign icon-white"></i> View All Personnel</a></li>
          		<!-- <li><a href="#"><i class="icon-search icon-white"></i> Search for Personnel</a></li> -->
          	</ul>
          </li>

          <?php if (!empty($user->id)) { if ($user->id){ ?>
          <li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Feedback <b class="caret"></b></a>
          	<ul class="dropdown-menu">
          		<li><a href="public_list_complaints.php"><i class="icon-info-sign icon-white"></i> View All Complaints</a></li>
          		<li><a href="public_create_complaint.php"><i class="icon-plus icon-white"></i> Add Complaint</a></li>
          		<li class="divider"></li>
          		<li><a href="public_list_feedback_items.php"><i class="icon-info-sign icon-white"></i> View Feedback Provided</a></li>
          		<li><a href="public_create_feedback.php"><i class="icon-plus icon-white"></i> Provide Feedback</a></li>
          	</ul>
          </li>
          <?php } } ?>

          <li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> <b class="caret"></b></a>
          	<ul class="dropdown-menu">
                <li><a href="user_manual.php">How to use Gaman</a></li>
                <li><a href="survey_info.php">Survey Info</a></li>
                <li><a href="test.php">Test</a></li>
          	</ul>
          </li>

          <!--
          <li<?php if (!empty($page) && $page == 'user_manual'){echo ' class="active"';}?>><a href="user_manual.php">How to use Gaman</a></li>
          <li<?php if (!empty($page) && $page == 'survey_info'){echo ' class="active"';}?>><a href="survey_info.php">Survey Info</a></li>
          <li<?php if (!empty($page) && $page == 'test'){echo ' class="active"';}?>><a href="test.php">Test</a></li>
          -->

        </ul>
        <ul class="nav navbar-nav pull-right">

        <!--
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <div id="multiple-datasets-navbar">
              <input type="text" class="form-control typeahead" id="main-search" placeholder="Search" maxlength="50" width="20px">
            </div>
          </div>
        </form>
        -->

          <li><a href="./admin">Admin Area</a></li>

          <?php

          if (!empty($session->id) && $session->object_type == 6) { // object_type 6 commuter

          	?>
          	<li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
          	<i class="icon-user icon-white"></i> <?php if (!empty($user->id)) { echo $user->full_name(); } ?> <b class="caret"></b>
          	</a>
          	<ul class="dropdown-menu">
          		<li><a href="public_view_profile.php"><i class="icon-info-sign icon-white"></i> View Profile</a></li>
          		<li><a href="logout.php"><i class="icon-off icon-white"></i> Logout</a></li>
          	</ul>
          	</li>
          <?php	} else { ?>
          	<li><a href="login.php">Login</a></li>
          <?php } ?>

        </ul>
      </div><!--/.nav-collapse -->

    </div>
  </div>
</div>
