<?php

/**
* Signup
* 
* New user registration
* 
*/

require_once 'config/config.php';
require_once 'rb/rb.php';

if (isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] === "POST") {
	$errors = array();
	if (trim($_POST['login']) =='') {
		$errors[] = 'Enter username!';
	}
	if ($_POST['email'] =='') {
		$errors[] = 'Enter email!';
	}
	if ($_POST['password'] =='') {
		$errors[] = 'Enter password!';
	}

	if (R::count('users', "login = ?", array($_POST['login'])) > 0)
	{
		$errors[] = 'User with this login exists!';
	}

	if (R::count('users', "email = ?", array($_POST['email'])) > 0)
	{
		$errors[] = 'User with this email exists!';
	}

	$headers = [
		"alg" => "HS256",
		"typ" => "JWT"
	];
	$headers_encoded = base64url_encode(json_encode($headers));

	$payload = [
		"sub" => "1234567890",
		"name" => $_POST['login']
	];
	$payload_encoded = base64url_encode(json_encode($payload));

	$key = 'secret';
	$signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
	$signature_encoded = base64url_encode($signature);

	$jwt_token = "$headers_encoded.$payload_encoded.$signature_encoded";

	if (empty($errors)) {
		$user = R::dispense('users');
		$user->login = $_POST['login'];
		$user->email = $_POST['email'];
		$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user->jwt_token = $jwt_token;
		R::store($user);
		echo "<div class='alert alert-success' style='margin-top: 20px; text-align: center;'>You have successfully registered! You can <a href='login.php'>login</a> to your account.</div><hr>";
	} else {
		echo "<div id='errors' class='alert alert-danger' style='margin-top: 20px; text-align: center;'>".array_shift($errors). "</div><hr>";
	}
}

function base64url_encode($data) {
	return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<title>signup</title>
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
                        <label>Your email:</label>
                        <input type="email" name="email" value="<?php echo @$_POST['email'];?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Your password:</label>
                        <input type="password" name="password" value="<?php echo @$_POST['password'];?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit" name="signup">Signup</button>
                        <a href="index.php" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
		</div>
	</div>
	</body>
</html>
