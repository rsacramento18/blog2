<?php
include_once '../mysqlconfig.php';
include_once 'functions.php';


/* unset($_SESSION['user']); */
session_start(); 
session_destroy();
header('Location: index.php');



?>
