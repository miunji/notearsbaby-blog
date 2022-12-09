<?php

/**
* Database connection
* 
*/

require_once 'rb/rb.php';

R::setup('mysql:host=localhost; dbname=blog', 'root', '', false); 
session_start();
 
if ( !R::testConnection() ) {
    exit ('No DB connection!');
}
