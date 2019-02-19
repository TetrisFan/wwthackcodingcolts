<?php
session_start();
// initializing variables
$studentid = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'PASSWORD', 'clubapp'); 

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $studentid = mysqli_real_escape_string($db, $_POST['studentid']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($studentid)) { array_push($errors, "Student ID is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  }
  if ($password_1 == $studentid) { 
    array_push($errors, "Password cannot match student ID");
  }



  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM clubapp.users WHERE StudentID='$studentid' LIMIT 1"; 
  $result = mysqli_query($db, $user_check_query);
  $student = mysqli_fetch_assoc($result);
  
  if ($student) { // if user exists
    if ($student['StudentID'] === $studentid) {
      array_push($errors, "Student ID already exists");
    }

  }


 $id_check_query = "SELECT * FROM clubapp.students WHERE studentid='$studentid' LIMIT 1"; 
  $result = mysqli_query($db, $id_check_query);
  $id = mysqli_fetch_assoc($result);
  
  if (! $id) { // if id does not exist
    array_push($errors, "Student ID does not exist");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = $password_1;
    $query = "INSERT INTO clubapp.users (StudentID, Password) 
          VALUES('$studentid', '$password')";
    mysqli_query($db, $query);

// create a session for the logged in student's id and name
    $query2 = "SELECT name, picture FROM clubapp.students WHERE studentid = '$studentid'";
    $results2 = mysqli_query($db, $query2);
    $row = mysqli_fetch_array($results2);
    $_SESSION['loggedin'] = $row['name'];
    $_SESSION['studentid'] = $studentid;
    $_SESSION['picture'] = $row['picture'];

    
// create a session for the loggin in student's officer status
    //$queryOfficer = "SELECT * from clubapp.clubstudents WHERE StudentID = '$studentid'";
    //$resultsOfficer = mysqli_query($db, $queryOfficer);
    //$rowOfficer = mysqli_fetch_array($resultsOfficer);
    //$_SESSION['Officer'] = $rowOfficer['Officer'];
    header('location: club-stream.php'); 
  }
}

// LOGIN USER

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

    $query = "SELECT * FROM clubapp.users WHERE StudentID='$studentid' AND Password='$password'";
    $results = mysqli_query($db, $query);
    
    if (mysqli_num_rows($results) == 1) {
      
        $query2 = "SELECT name, picture FROM clubapp.students WHERE studentid = '$studentid'";
        $results2 = mysqli_query($db, $query2);
        $row = mysqli_fetch_array($results2);
        $_SESSION['loggedin'] = $row['name'];
        $_SESSION['studentid'] = $studentid;
        $_SESSION['picture'] = $row['picture'];
        //$queryOfficer = "SELECT * from clubapp.clubstudents WHERE studentid = '$studentid'";
        //$resultsOfficer = mysqli_query($db, $queryOfficer);
        //$rowOfficer = mysqli_fetch_array($resultsOfficer);
        //$_SESSION['officer'] = $rowOfficer['officer'];
        header('location: club-stream.php');
    } else {
      array_push($errors, "Wrong student id/password combination");
    }
     
  }
}


if (isset($_POST['submit_post'])) 
  {
  $headline = mysqli_real_escape_string($db, $_POST['headline']);
  $desc = mysqli_real_escape_string($db, $_POST['desc']);

  $query = "INSERT INTO clubapp.posts (`user`, `headline`, `desc`, `time`) VALUES('".$_SESSION['loggedin']."', '$headline', '$desc', now())" ;
  $results = mysqli_query($db, $query); //or die(mysqli_error($db));
  header('location: club-profile-admin.php#posts');
  } 

/*
if (isset($_POST['edit_desc'])) 
{
  $clubdesc = mysqli_real_escape_string($db, $_POST['clubdesc']);

  $query = "INSERT INTO clubapp.club VALUES('$clubdesc')";
  $results = mysqli_query($db, $query);
}
*/  

//Display Posts

?>

