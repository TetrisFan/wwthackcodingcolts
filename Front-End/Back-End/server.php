<?php
session_start();
// initializing variables
$studentid = "";
//$fname = "";
//$lname = "";
//$email = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'PASSWORD', 'clubapp'); 

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $studentid = mysqli_real_escape_string($db, $_POST['studentid']);
  //$fname = mysqli_real_escape_string($db, $_POST['fname']);
  //$lname = mysqli_real_escape_string($db, $_POST['lname']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($studentid)) { array_push($errors, "Student ID is required"); }
  //if (empty($fname)) { array_push($errors, "First name is required"); }
  //if (empty($lname)) { array_push($errors, "Last name is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if ($password_1 == $studentid) { 
    array_push($errors, "Password cannot match student ID");
  }



  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM clubapp.users WHERE studentid='$studentid' LIMIT 1"; 
  $result = mysqli_query($db, $user_check_query);
  $student = mysqli_fetch_assoc($result);
  
  if ($student) { // if user exists
    if ($student['StudentID'] === $studentid) {
      array_push($errors, "Student ID already exists");
    }

  }


 $id_check_query = "SELECT * FROM clubapp.users WHERE studentid='$studentid' LIMIT 1"; 
  $result = mysqli_query($db, $id_check_query);
  $id = mysqli_fetch_assoc($result);
  
  if (! $id) { // if id does not exist
    array_push($errors, "Student ID does not exist");
  }

    $query2 = "SELECT name FROM clubapp.users WHERE studentid = '$studentid'";
    $results2 = mysqli_query($db, $query2);
    $row = mysqli_fetch_array($results2);
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO clubapp.users (studentid, password) 
  			  VALUES('$studentid', '$password')";
  	mysqli_query($db, $query);
  	//$_SESSION['studentid'] = $fname;
  	//$_SESSION['success'] = "You are now logged in";
    $_SESSION['loggedin'] = $row['name'];
    $_SESSION['StudentID'] = $studentid;
  	header('location: your-clubs.html'); 
  }
}

if (isset($_POST['login_student'])) {
  $studentid = mysqli_real_escape_string($db, $_POST['studentid']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($studentid)) {
    array_push($errors, "Student ID is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {

    $query = "SELECT * FROM clubapp.users WHERE studentid='$studentid' AND  password='$password'";
    $results = mysqli_query($db, $query);
    $query2 = "SELECT name FROM clubapp.users WHERE studentid = '$studentid'";
    $results2 = mysqli_query($db, $query2);
    $row = mysqli_fetch_array($results2);
    if (mysqli_num_rows($results) == 1) {
     // $_SESSION['studentid'] = $row['firstname'];
      //$_SESSION['success'] = "You are now logged in";
      header('location: club-profile-admin.php');
        $_SESSION['loggedin'] = $row['name'];
        $_SESSION['StudentID'] = $studentid;
       // $_SESSION['userlevel'] = $row[$this->user_level];
    } else {
      array_push($errors, "Wrong student id/password combination");
    }
     
  }
}


if (isset($_POST['submit_post'])) 
{
  $headline = mysqli_real_escape_string($db, $_POST['headline']);
  $desc = mysqli_real_escape_string($db, $_POST['desc']);

  if (empty($headline)) { array_push($errors, "Headline is required"); }
  if (empty($desc)) { array_push($errors, "Text is required"); }

  if (count($errors) == 0) {
    $query = "INSERT INTO clubapp.posts (`user`, `headline`, `desc`, `time`) VALUES('".$_SESSION['loggedin']."', '$headline', '$desc', now())" ;
    $results = mysqli_query($db, $query) or die(mysqli_error($db));
  }
} 

  $query2 = "SELECT * FROM clubapp.posts order by id desc"; 
  $results2 = mysqli_query($db, $query2);
  $row=mysqli_fetch_array($results2);

//Display Posts

?>
