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


$firstname = "document.write(firstname);";
$lastname = "document.write(lastname);";
$email = "document.write(email);";

$picture = "document.write(image);";
echo gettype($picture);

//$query = "INSERT INTO clubapp.googlelogin (uid, first_name,last_name,email,picture) VALUES ('$uid', '$firstname','$lastname','$email','$picture')";
$query = "INSERT INTO clubapp.googlelogin (uid, first_name,last_name,email,picture) VALUES ('1', 'test','test','test','test')";
mysqli_query($db,$query);

?>