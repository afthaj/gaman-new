<?php
require_once("../includes/initialize.php");
require_once("../includes/page-scripts/admin-login.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login &middot; Gaman</title>
    <?php require_once('../includes/layouts/header-admin.php');?>

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

        <div class="control-group">
        	<div class="controls">
        	<label class="control-label">Login as:</label>
        		<select name="object_type">
        			<option value="<?php echo $object_type_admin->id; ?>"><?php echo $object_type_admin->display_name; ?></option>
        			<option value="<?php echo $object_type_bus_personnel->id; ?>"><?php echo $object_type_bus_personnel->display_name; ?></option>
        		</select>
        	</div>
        </div>

        <div class="form-actions">
        	<button class="btn btn-block btn-primary" type="submit" name="submit">Sign in</button>
        </div>

      </form>

    </div> <!-- /container -->

  </body>
</html>
