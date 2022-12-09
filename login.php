<?php

/**
* Login
* 
* Login with nickname and password
* 
*/

require_once 'config/config.php';
require_once 'rb/rb.php';

if (isset($_POST['do_login']) && $_SERVER['REQUEST_METHOD'] === "POST") {
	$errors = array();
	$user = R::findOne('users', 'login = ?', array($_POST['login']));
	if ($user) {
		if (password_verify($_POST['password'], $user->password)) {
			$_SESSION['logged_user'] = $user;
			echo "<div class='alert alert-success' style='margin-top: 20px; text-align: center;'>You are logged in! <br/> <a href='index.php'>Click</a> to return to the main page.</div><hr>";
		} else {
			$errors[] = 'Password entered incorrectly!';
		}
	} else {
		$errors[] = 'User is not found!';
	}

	if (!empty($errors)) {
	    echo "<div class='alert alert-danger' style='margin-top: 20px; text-align: center;'>".array_shift($errors)."</div><div style='text-align: center;'><a href='index.php' class='btn btn-info'>Back</a></div><hr>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<title>login</title>
</head>
    <body>
    <div class="container" style="margin-top: 70px;">
	    <div class="row">
	        <div class="col-md-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Your login</label>
                        <input type="text" name="login" value="<?php echo @$_POST['login'];?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Your password:</label>
                        <input type="password" name="password" value="<?php echo @$_POST['password'];?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit" name="do_login">Login</button>
                        <a href="index.php" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
		</div>
	</div>

	</body>
</html>
