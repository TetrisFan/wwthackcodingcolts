<?php

include ('server.php');
//include('server2.php');


if (isset($_POST['c1'])) {
$_SESSION['c1'] = $_POST['c1'];
$clubreceive = mysqli_real_escape_string($db, $_POST['c1']);
$clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($db));
}
else if (isset($_POST['submit']))
{
    $_SESSION['c1'] = $_POST['newClubName'];
    $clubreceive = mysqli_real_escape_string($db, $_POST['newClubName']);
    $clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($db));
}
else {
$clubreceive = mysqli_real_escape_string($db, $_SESSION['c1']);
$clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($db));
}

if ($_SESSION['clubCounter'] !==1)
{
  $clubreceive = mysqli_real_escape_string($db, $_SESSION['c1']);
  $_SESSION['clubCounter'] = 1;
}
$clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($db));
//$clubname = $_SESSION['club'];

$currentUserID = $_SESSION['studentid'];
//echo $currentUserID;


//$ = mysqli_real_escape_string($db, $_POST['headline']);
//$result = mysqli_query($db, "SELECT * FROM club WHERE ClubName =  '".$_SESSION['club']."'") or die(mysqli_error($db));



if ($db->connect_error)
{
    die("Connection failed: " . $db->connect_error);
}


$club = array();
$students = array();
$studentInfo = array();
$currentClub = array();
$studentInClub = array();

while(($row = mysqli_fetch_assoc($clubNames)))
{
    $club['ID'] = $row['ClubID'];
    $club['Name'] = $row['ClubName'];
    $club['Description'] = $row['ClubDescription'];
    $club['welcomeMessage'] = $row['welcome'];
}

$currentClubID = $club['ID'];

//print_r($club);

$resultStudents = mysqli_query($db, "SELECT * FROM clubstudents WHERE clubID = " . $club['ID']) or die(mysqli_error($db));

$resultStudentsForInsertion = mysqli_query($db, "SELECT * FROM clubstudents WHERE clubID =" . $club['ID']) or die(mysqli_error($db));

$clubid = $club['ID'];


?><!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- custom CSS -->
  <link rel="stylesheet" href="styles.css">
  <title>Club Profile</title>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
    <a href="/" class="navbar-brand d-flex w-50 mr-auto"><img class="logo" src="images/connect-me-logo2.png"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
            <li class="nav-item">
                <a class="nav-link navbar-nav-link border-0 mr-4" href="club-stream.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-0 mr-4" href="club-directory.php">Explore</a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <img class="navbar-profile-pic dropbtn" src="images/blank-avatar-green.png" onclick="myFunction()">
                <div id="myDropdown" class="dropdown-content">
                  <a href="interest-quiz.php">Interest Quiz</a>
                  <a href="your-clubs.php">Your Clubs</a>
                  <a href="index.php">Sign Out</a>
                </div>
              </div>
            </li>
        </ul>
    </div>
  </nav>
  <div class="nav-container">
    <ul class="nav nav-mytabs nav-pills justify-content-center align-items-center" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active px-sm-5 px-lg-5" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-sm-5 px-lg-5" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
      </li>
    </ul>
  </div>

  <div class="tab-content mytab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <main role="main" class="container mt-4">
        <div class="jumbotron d-flex flex-column align-items-center text-center">
          <div class="w-75 d-flex flex-column align-items-center">
            <h1 class="mb-4"><?php echo $club['Name']?></h1>
            <p><?php echo $club['Description']?></p>
            <form  f="club-profile.php" method='post'>
            <button type="submit" name = "button1" value="1" class="btn btn-primary mt-3 mb-3">Join Now</button>
            </form>
            <?php


             if(isset($_POST['button1']))
              {
                //echo $counter . "<br>" ;
                //echo "Clicking Detected <br>";
                $counter = 0;

                while (($row = mysqli_fetch_assoc($resultStudentsForInsertion)))
                {
                    $studentInClub['StudentID'] = $row['GoogleStudentID'];
                    $studentInClub['ClubID'] = $row["ClubID"];

                    if($currentUserID == $studentInClub['StudentID'])
                    {

                        $counter ++;
                        echo "You are already in this club.";
                    }


                }

              //echo $counter . "<br>";

                if ($counter == 0)
                {
                   /*Tre's prepare method
                  echo "executing statement <br>";
                  $stmt = $db->prepare("INSERT INTO clubstudents (ClubID,StudentID,Officer) VALUES(?,?,?)") or die(mysqli_error($db));
                  $stmt->bind_param("iii", $ClubID, $Student,$Officer);
                  //setting params
                  $ClubID = $club['ID'];
                  $Student = $currentUserID;
                  $Officer=0;
                  //if(!$stmt->execute()) echo $stmt->error;
                  $stmt->execute();
                  $counter ++;
                  echo "Finished!";*/


                  $insertion = "INSERT INTO clubapp.clubstudents (`ClubID`, `GoogleStudentID`, `Officer`) VALUES ('$clubid', '$currentUserID','0');";

                  mysqli_query($db, $insertion);

                  ?>

                  <script>
                  $(document).ready(function(){$('#welcome-msg').modal('show')})
                  </script>
                <?php

                }

              }
              ?>
            <div class="modal fade" id="welcome-msg" role="dialog"> <!-- welcome msg -->
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header d-flex flex-column align-items-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Welcome!</h4>
                  </div>
                  <div class="modal-body p-3">
                    <p><?php echo $club['welcomeMessage'];?></p>
                  </div>
                </div>
              </div>
            </div> <!-- welcome msg -->
          </div>
        </hr>
          <div class="w-75 d-flex flex-column justify-content-center">
            <h1 class="mt-4 mb-4">Members</h1>
            <div>

            </div>
            <div class="row d-flex flex-row justify-content-center">

                 <?php

                 $resultStudentsUpdated = mysqli_query($db, "SELECT * FROM clubstudents WHERE clubID = ".$club['ID']);


                while(($row = mysqli_fetch_assoc($resultStudentsUpdated)))
                {
                $students['StudentID'] = $row['GoogleStudentID'];
                $students['Officer'] = $row['Officer'];
                    $resultforStudent = mysqli_query($db, "SELECT * FROM googlelogin WHERE uid = " . $students['StudentID']) or die(mysqli_error($db));
                     while(($rowTwo = mysqli_fetch_assoc($resultforStudent)))
                     {
                         $studentInfo['firstname'] = $rowTwo['first_name'];
                         $studentInfo['lastname'] = $rowTwo['last_name'];
                         //$studentInfo['LastName'] = $rowTwo['LastName'];
                     }



                if($students['Officer'] == 1)
                {
                  ?>
              <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
                <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="">
                <a > <?php echo $studentInfo["firstname"]." ".$studentInfo["lastname"];?></a>
                <p class="club-role">Officer</p>
              </div>
          <?php }
                else
                {
                  ?>
              <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
                <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="">
                <p class="mb-0"> <?php echo $studentInfo["firstname"]." ".$studentInfo["lastname"];?></p>
                <p class="club-role">Member</p>
              </div>
                <?php
                }
                }
                ?>
             </div>

            </div>

            <div class="btn btn-primary mt-4 mb-1" style="background-color: #111753;" data-toggle="modal" data-target="#confirm-leave" id="Leave">Leave Club</div>

              <div class="modal fade" id="#confirm-leave" role="dialog"> <!-- are you sure you want to leave? msg -->
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header d-flex flex-column align-items-center">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Are you sure you want to leave?</h4>
                    </div>
                    <div class="modal-body p-3">
                      <button class="btn btn-primary" id="Leave">leave club</button>
                    </div>
                  </div>
                </div>
              </div>

          </div>


        </main>
      </div>
    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
      <main role="main" class="container mt-4 text-center d-flex flex-column align-items-center">
         <?php

         $resultsOfPosts = mysqli_query($db, "SELECT * FROM clubapp.posts WHERE clubid = '".$club['ID']."'ORDER BY time DESC") or die(mysqli_error($db));
$post = array();
while(($row = mysqli_fetch_assoc($resultsOfPosts)))
{
    $clubName = "";
    $post['Description'] = $row['desc'];
    $post['Headline'] = $row['headline'];
    $post['Time'] = $row['time'];
    $post['User'] = $row['user'];
    $Headline = $post['Headline'];
    $Description = $post['Description'];
    $Time = $post['Time'];
    $User = $post['User'];


    $FrontEnd = ('

    <div data-toggle="modal" data-target="#myModal1" class="headline-container">
      <div class="headline">
        <h1>%s</h1>
        <p class="post-club-name">Posted by %s at %s</p>
      </div>
      <div class="headline-text">%s</div>
    </div>

 ');

 echo sprintf($FrontEnd, $post['Headline'],$User , $Time,  $Description, $Headline, $Description);
}

  ?>
<!-- HERE IS THE ADMIN VIEW FOR POSTS ON THE CLUB ADMIN PAGE

  <div class="headline-container" onclick="myFunction1()">
    <div class="dropdown" class="mx-0 my-0">
      <div class="mx-0 my-0 d-flex flex-row justify-content-end newthingy">&hellip;</div>
        <div id="editdelete" class="dropdown-content">
          <a>edit</a>
          <a>delete</a>
        </div>
    </div>
    <div class="headline">
      <h1>%s</h1>
      <p class="post-club-name">Posted by %s at %s</p>
    </div>
    <div class="headline-text">%s</div>
  </div>

-->


<div class="dropdown">
  <div id="editdelete" class="dropdown-content">
    <a>edit</a>
    <a>delete</a>
  </div>
</div>


  <!-- custom JS -->
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script>
  $(document).ready(() => {
  let url = location.href.replace(/\/$/, "");

  if (location.hash) {
    const hash = url.split("#");
    $('#myTab a[href="#'+hash[1]+'"]').tab("show");
    url = location.href.replace(/\/#/, "#");
    history.replaceState(null, null, url);
    setTimeout(() => {
      $(window).scrollTop(0);
    }, 400);
  }

  $('a[data-toggle="tab"]').on("click", function() {
    let newUrl;
    const hash = $(this).attr("href");
    if(hash == "#home") {
      newUrl = url.split("#")[0];
    } else {
      newUrl = url.split("#")[0] + hash;
    }
    newUrl += "/";
    history.replaceState(null, null, newUrl);
  });
  });
  </script>

  <script>
    /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }

    $('#Leave').click(function() {
      $.ajax ({
        type: 'POST',
        url: 'leaveProcessing.php',
        success: function(result) {
          alert(result);
        },
        error: function(result) {
          alert(result);
        }
      })
    })
  </script>

  <script>
    /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
    function leaveClubConfirm() {
      document.getElementById("are-you-sure").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.newthingy')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>

</body>

</html>
