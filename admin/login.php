<?php
require_once("../includes/initialize.php");

//init code
$object_type_admin = $object_type_object->get_object_type_by_name("admin");
$object_type_bus_personnel = $object_type_object->get_object_type_by_name("bus_personnel");

//check login
if ($session->is_logged_in()){
	redirect_to("index.php");
}

if (isset($_POST['submit'])){

	$object_type = trim($_POST['object_type']);

	if ($object_type == 5 /*$object_type_admin->id*/) {

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$found_user_admin = $admin_user_object->authenticate($username, $password);

		if ($found_user_admin){
			$session->login($found_user_admin, $object_type_admin->id);
			redirect_to("index.php");
		} else {
			$session->message("username/password combination is incorrect. ");
		}

	} else if ($object_type == 4 /*$object_type_bus_personnel->id*/) {

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$found_user_bus_personnel = $bus_personnel_object->authenticate($username, $password);

		if ($found_user_bus_personnel){
			$session->login($found_user_bus_personnel, $object_type_bus_personnel->id);
			redirect_to("index.php");
		} else {
			$session->message("username/password combination is incorrect. ");
		}

	}

} else {
	$username = "";
	$password = "";
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login &middot; Gaman</title>
    <?php require_once('../includes/layouts/header_admin.php');?>

    <link href="../css/login-styles.css" rel="stylesheet" />

  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="login.php" method="post">

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
        	<button class="btn btn-large btn-primary" type="submit" name="submit">Sign in</button>
        </div>

      </form>

    </div> <!-- /container -->

    <?php require_once('../includes/layouts/scripts_admin.php');?>

  </body>
</html>
