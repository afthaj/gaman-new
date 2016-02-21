<?php
require_once("./includes/initialize.php");
require_once("./includes/page-scripts/test.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Test &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php $page = 'test';?>
      <?php require_once('./includes/layouts/navbar.php');?>

      <!-- Begin page content -->

      <header class="jumbotron subhead">
        <div class="container-fluid">
          <h1>Test Page</h1>
        </div>
      </header>

      <!-- Start Content -->

      <div class="container-fluid">

       	  <div class="row-fluid">
       	  <div class="span3">
       	  	<div class="sidenav" data-spy="affix" data-offset-top="200">
	        	<a href="#" class="btn btn-primary btn-block"><i class="icon-arrow-left icon-white"></i> Back to Home Page</a>
	        </div>
       	  </div>

       	  <div class="span9">

       	  <div class="row-fluid">
	       	  <section>

       	  	  	<?php echo $session->message; ?>

       	  	  	<?php

								echo pathinfo(__FILE__, PATHINFO_FILENAME);

								echo "<br/>";

								echo basename($_SERVER["REQUEST_URI"], ".php");

       	  	  	?>

       	  	  </section>

       	  	  </div>

       	  </div>

	      </div>

      </div>

      <!-- End Content -->



      <div id="push"></div>
    </div>

    <?php require_once('./includes/layouts/footer.php');?>

  </body>
</html>
