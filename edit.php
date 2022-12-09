<?php

/**
* Update
* 
* Get and edit post by id
* 
*/

require_once 'config/config.php';
require_once 'rb/rb.php';

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD']==="POST") {
	$post = R::load('posts', $_GET['id']);
	$post->author = $_POST['author'];
	$post->message = $_POST['message'];
	$id = R::store($post);

	if(is_int($id)) {
		$message = "<div class='alert alert-success'>Successfully updated</div>";
	}
} else {
	$post = R::load('posts', $_GET['id']);
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<title>edit post</title>
</head>
	<body>
	<?php if (isset($_SESSION['logged_user'])) { 
		if ($post->jwt_token === $_SESSION['logged_user']->jwt_token) { ?>
		<div class="container" style="margin-top: 70px;">
			<div class="row">
				<div class="col-md-4">
				<?php echo isset($message) ? $message : ''; ?>
					<form action="" method="POST">

						<input type="hidden" name="post_id" value="<?php echo $post->id; ?>"/>

						<div class="form-group">
							<label>Author</label>
							<input required readonly value="<?php echo $post->author; ?>" type="text" name="author" class="form-control" />
						</div>

						<div class="form-group">
							<label>Message</label>
							<textarea required type="text" name="message" class="form-control ckeditor" rows="3"><?php echo $post->message; ?></textarea>
						</div>

						<div class="form-group">
							<button class="btn btn-info" name="submit">Update</button>
							<a href="index.php" class="btn btn-info">Back</a>
						</div>

					</form>
				</div>
			</div>
		</div>
		<?php } else { ?>
			<div class='alert alert-danger' style="margin-top: 20px; text-align: center;">Only the author of a post can edit it!</div>
			<div style="text-align: center;">
				<a href="index.php" class="btn btn-info">Back</a>
			</div><hr>
		<?php } ?>
	<?php } else { ?>
		<div class='alert alert-danger' style="margin-top: 20px; text-align: center;">Log in to perform this action!</div>
        <div style="text-align: center;">
			<a href="login.php" class="btn btn-info">Login</a>
			<a href="signup.php" class="btn btn-info">Signup</a>
			<a href="index.php" class="btn btn-info">Back</a>
		</div><hr>
	<?php } ?>

	<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
	</body>
</html>
