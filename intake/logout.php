<?php
// Start Session
session_start();

//Terminate Session
session_destroy();
$_SESSION = array();

//Take you to index.php
header("location: index.php");