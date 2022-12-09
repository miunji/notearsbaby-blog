<?php

/**
* Delete
* 
* Get and delete a post by id
* 
*/

require_once 'config/config.php';
require_once 'rb/rb.php';

$post = R::load('posts', $_GET['id']);

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<title>delete post</title>
</head>
    <body>
    <?php if (isset($_SESSION['logged_user'])) {
        if ($post->jwt_token === $_SESSION['logged_user']->jwt_token) {
            $status = R::trash($post);
            header('location: index.php');
        } else { ?>
            <div class='alert alert-danger' style="margin-top: 20px; text-align: center;">Only the author of a post can delete it!</div>
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
    </body>
</html>
