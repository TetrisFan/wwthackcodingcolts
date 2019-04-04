<?php
include ('server.php');

//These will eventually be replaced with sesssion variables, but for now:
//$clubName = isset($_POST['c1'])?$_POST['c1']:"";


if (isset($_POST['c1'])) {
$_SESSION['c1'] = $_POST['c1'];
$clubreceive = mysqli_real_escape_string($db, $_POST['c1']);
$clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($conn));
}
else {
$clubreceive = mysqli_real_escape_string($db, $_SESSION['c1']);
$clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($conn));
}
//$clubname = $_SESSION['club'];
if ($_SESSION['clubCounter'] !==1)
{
  $clubreceive = mysqli_real_escape_string($db, $_SESSION['c1']);
  $_SESSION['clubCounter'] = 1;
}
$clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($db));

$currentUserID = $_SESSION['studentid'];



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
}

$currentClubID = $club['ID'];


//print_r($club);

$resultStudents = mysqli_query($db, "SELECT * FROM clubstudents WHERE clubID = " . $club['ID']) or die(mysqli_error($db));

$resultStudentsForInsertion = mysqli_query($db, "SELECT * FROM clubstudents WHERE clubID =" . $club['ID']) or die(mysqli_error($db));

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- custom CSS -->
  <link rel="stylesheet" href="styles.css">
  <title>Club Profile</title>
</head>

<body>
  <nav class="navbar">
    <a class="navbar-brand" href="club-stream.php"> <img class="logo" src="images/connect-me-logo2.png"> </a>
    <div class="d-flex flex-row align-items-center">
      <a class="nav-link mr-5 b-0" href="club-stream.php">Home</a>
      <a class="nav-link mr-5 b-0" href="club-directory.php">Explore</a>
      <div class="dropdown">
        <img class="navbar-profile-pic dropbtn" src="images/blank-avatar-green.png" onclick="myFunction()">
        <div id="myDropdown" class="dropdown-content">
          <a href="interest-quiz.php">Interest Quiz</a>
          <a href="your-clubs.php">Your Clubs</a>
          <a href="index.html">Sign Out</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="nav-container">
    <ul class="nav nav-mytabs nav-pills justify-content-center align-items-center" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active px-sm-5 px-lg-5" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-sm-5 px-lg-5" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">posts</a>
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
            <button class="btn btn-primary mb-3 mt-2" type="button" data-toggle="collapse" data-target="#editDesc" aria-expanded="false" aria-controls="editDesc">
              Edit club description
            </button>
            <div class="collapse w-100 mt-3" id="editDesc">
              <form class = "form-signin" method="post" action="club-profile-admin.php">
                <div class="form-group">
                  <textarea class="form-control rounded-0" rows="10" name="clubdesc" placeholder="Edit your club description."></textarea>
                </div>
                  <?php
                    if(isset($_POST['clubdesc'])) {
                      $change = mysqli_real_escape_string($db, $_POST['clubdesc']);
                      $name = mysqli_real_escape_string($db, $club['Name']);
                      $query = mysqli_query($db, "UPDATE club SET ClubDescription = '$change' WHERE ClubName = '$name'") or die(mysqli_error($conn));
                    }
                  ?>
                <button type="submit" role="button" name="edit_desc" class="btn btn-primary mt-3 mb-2">save changes</button>
              </form>
            </div>
              <?php if(isset($_POST['clubdesc'])) : ?>
                <p><?php echo "Description successfully updated" ?></p>
              <?php endif; ?>
          </div>
          <hr>
          <div class="w-75 d-flex flex-column justify-content-center">
            <h1 class="mt-4 mb-4">Members</h1>
            <div class="row d-flex flex-row justify-content-center">
                               <?php
                              while(($row = mysqli_fetch_assoc($resultStudents)))
                              {
                              $students['StudentID'] = $row['StudentID'];
                              $students['Officer'] = $row['Officer'];
                                  $resultforStudent = mysqli_query($db, "SELECT * FROM students WHERE StudentID = " . $students['StudentID']) or die(mysqli_error($db));
                                   while(($rowTwo = mysqli_fetch_assoc($resultforStudent)))
                                   {
                                       $studentInfo['name'] = $rowTwo['name'];
                                       //$studentInfo['LastName'] = $rowTwo['LastName'];
                                   }



                              if($students['Officer'] == 1)
                              {
                                ?>
                            <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
                              <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="">
                              <a > <?php echo $studentInfo["name"];?></a>
                              <p class="club-role">Officer</p>
                            </div>
                        <?php }
                              else
                              {
                                ?>
                            <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
                              <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="">
                              <p class="mb-0"> <?php echo $studentInfo['name'];?></p>
                              <p class="club-role">Member</p>
                            </div>
                              <?php
                              }
                              }
                              ?>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
      <main role="main" class="container mt-4 text-center d-flex flex-column align-items-center">


        <button class="btn-primary btn mb-4" data-toggle="modal" data-target="#new-post" style="width: 80%;">Create a new post</button>
        <div class="modal fade" id="new-post" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form class = "form-group" method="post" action="club-profile-admin.php#posts">
              <div class="modal-header d-flex flex-column align-items-center">
                <button type="button" class="close mb-2" data-dismiss="modal">&times;</button>
                <form class="w-100">
                  <div class="form-group">
                    <textarea class="form-control rounded-0" rows="1" name="headline" placeholder="Post title" required></textarea>
                  </div>
                  <textarea class="form-control rounded-0" rows="10" name="desc" placeholder="Post description." required></textarea>
                  <button type="submit" class="btn btn-primary mt-3" role="button" name="submit_post">post</button>
                </form>
              </div>
            </div>
          </div>
        </div> <!-- edit modal -->


         <?php


         if (isset($_POST['submit_post']))
  {
  $headline = mysqli_real_escape_string($db, $_POST['headline']);
  $desc = mysqli_real_escape_string($db, $_POST['desc']);

  $query = "INSERT INTO clubapp.posts (`user`, `headline`, `desc`, `time`, `clubid`) VALUES('".$_SESSION['loggedin']."', '$headline', '$desc', now(), '".$club['ID']."')" ;
  $results = mysqli_query($db, $query); //or die(mysqli_error($db));

  //header('location: club-stream.php');
  }

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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- custom JS -->
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
  </script>
</body>

</html>
