<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-survey-info.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Survey Info &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('../includes/layouts/header-admin.php');?>
  </head>

  <body>

    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'survey_info';?>
      <?php require_once('../includes/layouts/navbar-admin.php');?>

      <!-- Begin page content -->

      <header class="jumbotron subhead">
        <div class="container-fluid">
          <h1>Survey Info</h1>
        </div>
      </header>

      <!-- Start Content -->

      <div class="container-fluid">

       	  <div class="row-fluid">
       	  <div class="span3">
       	  	<div class="sidenav" data-spy="affix" data-offset-top="200">
	        	<a href="./" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Home Page</a>
	        </div>
       	  </div>

       	  <div class="span9">

       	  <div class="row-fluid">
	       	  <section>

       	  	  	<?php echo $session->message; ?>

       	  	  	<?php

       	  	  	$time = time();

       	  	  	echo $time;

       	  	  	echo '<br /><br />';

       	  	  	print_r(getdate($time));

       	  	  	echo '<br /><br />';

       	  	  	print date("r", $time);

       	  	  	echo '<br /><br />';

       	  	  	print date("d/m/y h:i:s a", $time);

       	  	  	echo '<br /><br />';

       	  	  	print date("d/m/Y h:i:s a", mktime(13, 29, 45, 11, 18, 1988));

       	  	  	echo '<br /><br />';

       	  	  	echo mktime(00, 00, 00, 11, 18, 1988);
       	  	  	echo '<br /><br />';

       	  	  	echo PHP_OS;

       	  	  	echo '<br /><br />';

       	  	  	echo php_uname('s');



       	  	  	?>

       	  	  </section>

       	  	  </div>

       	  </div>

	      </div>

      </div>

      <!-- End Content -->



      <div id="push"></div>
    </div>

    <?php require_once('../includes/layouts/footer-admin.php');?>

  </body>
</html>
