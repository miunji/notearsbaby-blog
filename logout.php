<?php 

/**
* Logout
* 
*/

require_once 'config/config.php';
require_once 'rb/rb.php';

unset($_SESSION['logged_user']);

header('Location: index.php');
?>
