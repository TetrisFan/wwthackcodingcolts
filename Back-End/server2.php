<?php 

session_start();
// initializing variables
$uid = "";
$firstname = "";
$lastname = "";
$email = "";
$picture = "";

$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'PASSWORD', 'clubapp');

$uid =  "document.write(id);";
echo $uid;

$firstname = "document.write(firstname);";
$lastname = "document.write(lastname);";
$email = "document.write(email);";
$picture = "document.write(image);";


?>