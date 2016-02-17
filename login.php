<?php
require_once("./includes/initialize.php");


 if ($session->is_logged_in()){
 	//redirect_to("index.php");
 }

if (isset($_POST['submit'])){
	
	$object_type = 6; // for 'commuter' object_type
	
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	$commuter = new Commuter();
	$found_user = $commuter->authenticate($username, $password);
	
	if ($found_user){
		$session->login($found_user, $object_type);
		redirect_to("index.php");
	} else {
		$session->message("username/password combination is incorrect. ");
		redirect_to("login.php");
	}
	
} else {
	$username = "";
	$password = "";
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login &middot; <?php echo WEB_APP_NAME; ?></title>
    <?php require_once('./includes/layouts/header.php');?>
    
    <link href="css/login-styles.css" rel="stylesheet" />
    
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
        
        <div class="form-actions">
        	<button class="btn btn-large btn-primary" type="submit" name="submit">Sign in</button>
        </div>
      
      </form>

    </div> <!-- /container -->

    <?php require_once('./includes/layouts/scripts.php');?>

  </body>
</html>
