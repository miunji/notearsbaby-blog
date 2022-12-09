<?php

/**
* Create
* 
* Adding a new post
* 
*/

require_once 'config/config.php';
require_once 'rb/rb.php';

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === "POST") {
	date_default_timezone_set('Europe/Moscow');

	$user = R::findOne('users', 'login = ?', array($_POST['author']));

	$post = R::dispense('posts');
	$post->author = $_POST['author'];
	$post->message = $_POST['message'];
	$post->date = date('d-m-y h:i');
	$post->jwt_token = $user->jwt_token;
	$id = R::store($post);

	if (is_int($id)) {
		$message = "<div class='alert alert-success'>Successfully added</div>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<title>add post</title>
</head>
	<body>
	<?php if (isset($_SESSION['logged_user'])) { ?>
	<div class="container" style="margin-top: 70px;">
		<div class="row">
			<div class="col-md-4">
			<?php echo isset($message) ? $message : ''; ?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Author</label>
						<input required readonly type="text" name="author" value="<?php echo $_SESSION['logged_user']->login; ?>" class="form-control" />
					</div>

					<div class="form-group">
						<label>Message</label>
						<textarea required type="text" name="message" class="form-control ckeditor" rows="3"></textarea>
					</div>

					<div class="form-group">
						<button class="btn btn-info" name="submit">Submit</button>
						<a href="index.php" class="btn btn-info">Back</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	<?php } else { ?>
		<div class='alert alert-danger' style="margin-top: 20px; text-align: center;">Log in to add a new post!</div>
        <div style="text-align: center;">
			<a href="login.php" class="btn btn-info">Login</a>
			<a href="signup.php" class="btn btn-info">Signup</a>
			<a href="index.php" class="btn btn-info">Back</a>
		</div><hr>
	<?php } ?>

	<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
	</body>
</html>
