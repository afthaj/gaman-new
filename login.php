<?php
require_once("./includes/initialize.php");
require_once("./includes/page-scripts/login.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>

  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="login.php" method="post">

        <div class="control-group">
        	<div class="controls">
              <a href="./" class="btn btn-warning"><i class="icon-chevron-left icon-white"></i> Back</a>
          </div>
        </div>

        <div class="control-group">
        	<h2 class="form-signin-heading">Please sign in</h2>
        </div>

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

        <div class="control-group">
        	<div class="controls">
        		<input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo htmlentities($username); ?>">
        	</div>
        </div>

        <div class="control-group">
        	<div class="controls">
        		<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo htmlentities($password); ?>">
        	</div>
        </div>

        <div class="form-actions">
        	<button class="btn btn-block btn-primary" type="submit" name="submit">Sign in</button>
        </div>

      </form>

    </div> <!-- /container -->

  </body>
</html>
