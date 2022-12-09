<?php

/**
* Get all
* 
* Find and show all existing posts
* 
*/

require_once 'config/config.php';
require_once 'rb/rb.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<title>blog</title>
</head>
	<body>
	<div class="container" style="margin: 70px;">
		<div class="log" style="text-align: right;">
		<?php if (isset($_SESSION['logged_user'])) {
			echo "<b>Hello,"." ".$_SESSION['logged_user']->login."!</b><br>";
			echo "<a href='logout.php'><b>Logout</b></a>";

		} else {
			echo "<a href='login.php'><b>Login</b></a><br>";
			echo "<a href='signup.php'><b>Signup</b></a><br>";
		} ?>
		</div>
		<a class="btn btn-info" href="add.php" style="margin-bottom: 10px;">Add Post</a>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-condensed table-stripped table-hover">
						<tr>
							<th>Date</th>
							<th>Message</th>
							<th>Author</th>
							<th>Options</th>
						</tr>
						<tbody>
							<?php foreach (R::findAll('posts', 'ORDER BY id DESC') as $post) {
								echo "<tr>";
								echo "<td>".$post['date']."</td>";
								echo "<td>".$post['message']."</td>";
								echo "<td>".$post['author']."</td>";
								echo "<td><a class='btn btn-success' href='detail.php?id=".$post['id']."' style='margin-right: 5px;'><i class='glyphicon glyphicon-eye-open'></i> </a>";
								if (isset($_SESSION['logged_user'])) { 
									if ($post['jwt_token'] === $_SESSION['logged_user']->jwt_token) {
										echo "<a class='btn btn-info' href='edit.php?id=".$post['id']."'><i class='glyphicon glyphicon-pencil'></i> </a>
										<a class='btn btn-danger' href='delete.php?id=".$post['id']."'><i class='glyphicon glyphicon-trash'></i> </a>";
									}
								}
								echo "</td>";
								echo "</tr>";
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
