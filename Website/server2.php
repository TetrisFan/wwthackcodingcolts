<?php 

session_start();
// initializing variables
$uid = "";
$firstname = "";
$lastname = "";
$email = "";
$image = "";

$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'PASSWORD', 'clubapp');

$uid =  $_POST['uid'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$image = $_POST['image'];

$query = "SELECT * FROM clubapp.googlelogin WHERE uid = '$uid'";
$results = mysqli_query($db, $query);
$resultarray = mysqli_fetch_array($results);
//mysqli_num_rows($results);

if(mysqli_num_rows($results)==0)
{
	$query1 = "INSERT INTO clubapp.googlelogin (uid, first_name,last_name,email,picture) VALUES ('$uid','$firstname','$lastname','$email','$image')";
	mysqli_query($db,$query1);
	header('location:./welcome.php');
	
}elseif($resultarray['superuser'] == 1) // Checks if the user is actually a superuser
{?>
	<script> window.location.replace('./club-stream-superuser.php');</script>
<?php
}else
{ ?>
	<script>window.location.replace('./club-stream.php');</script>
<?php
}
$_SESSION['loggedin'] = $firstname." ".$lastname;
$_SESSION['studentid'] = $uid;
//echo $uid;
?>