<?php

include ('server.php');

//These will eventually be replaced with sesssion variables, but for now:
//$clubName = isset($_POST['c1'])?$_POST['c1']:"";
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "PASSWORD";
$dbName = "clubapp";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if (isset($_POST['c1'])) {
$_SESSION['c1'] = $_POST['c1'];
$clubreceive = mysqli_real_escape_string($conn, $_POST['c1']);
$clubNames = mysqli_query($conn,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($conn));
}
else {
$clubreceive = mysqli_real_escape_string($conn, $_SESSION['c1']);
$clubNames = mysqli_query($conn,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($conn));
}

if ($_SESSION['clubCounter'] !==1)
{
  $clubreceive = mysqli_real_escape_string($db, $_SESSION['c1']);
  $_SESSION['clubCounter'] = 1;
}
$clubNames = mysqli_query($db,"SELECT * FROM club WHERE Clubname LIKE '".$clubreceive."%'") or die(mysqli_error($db));
//$clubname = $_SESSION['club'];

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
  <nav class="navbar">
    <a class="navbar-brand" href="club-stream.php"> <img class="logo" src="images/connect-me-logo2.png"> </a>
    <div class="d-flex flex-row align-items-center">
      <a class="nav-link mr-5 b-0" href="club-stream.php">Home</a>
      <a class="nav-link mr-5 b-0" href="club-directory.php">Explore</a>
      <div class="dropdown">
        <img class="navbar-profile-pic dropbtn" src="<?php echo $_SESSION['picture']; ?>" onclick="myFunction()">
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
            <form  action="club-profile.php" method='post'>
            <button type="submit" name = "button1" value="1" data-toggle="modal" data-target="#welcome-msg" class="btn btn-primary mt-3 mb-3">join now</button>
            </form>
            <?php
            settype($_SESSION ['firstjoin'], "integer");
            //echo $_SESSION['firstjoin'];  //session test statment
            if ($_SESSION['firstjoin'] ==1)
            {

              ?>

              <script>
              $(document).ready(function(){$('#welcome-msg').modal('show')})
              </script>
            <?php
              $_SESSION ['firstjoin'] = 0;
            }


             if(isset($_POST['button1']))
              {
                //echo $counter . "<br>" ;
                //echo "Clicking Detected <br>";
                $counter = 0;

                while (($row = mysqli_fetch_assoc($resultStudentsForInsertion)))
                {
                    $studentInClub['StudentID'] = $row['StudentID'];
                    $studentInClub['ClubID'] = $row["ClubID"];

                    if($currentUserID == $studentInClub['StudentID'])
                    {

                        $counter ++;
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


                  $insertion = "INSERT INTO clubapp.clubstudents (`ClubID`, `StudentID`, `Officer`) VALUES ('$clubid', '$currentUserID','0');";

                  mysqli_query($db, $insertion);
                  $_SESSION['firstjoin'] = 1;
                }
                 else
                 {
                     $_SESSION['firstjoin'] = 0;
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
                    <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat
                      diam tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis
                      tristique orci libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et
                      pulvinar in, interdum ac diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                  </div>
                </div>
              </div>
            </div> <!-- welcome msg -->
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
        </div>
      </main>
    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
      <main role="main" class="container mt-4 text-center d-flex flex-column align-items-center">
         <?php

        $query2 = "SELECT * FROM clubapp.posts order by id desc";
        $results2 = mysqli_query($db, $query2);
        $row=mysqli_fetch_array($results2);

      for ($id = $row[0]; $id >= 1; $id--) {

        $query = "SELECT * FROM clubapp.posts WHERE id = '$id'";
        $results = mysqli_query($db, $query);
        $posts=mysqli_fetch_array($results);

        ?>

        <div data-toggle="modal" data-target="#myModal1" class="headline-container">
          <div class="headline">
            <h1><?php echo $posts[2];?></h1>
            <p class="post-club-name"> Posted by <?php echo $posts[1];?> at <?php echo $posts[4];?> </p>
            <div class="headline-text"> <?php echo $posts[3];?> </div>
          </div>
        </div>
        <br>

  <?php
      }
  ?>
        <div> <!-- modal 1 -->
          <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1>Headline</h1>
                  <p class="post-club-name mb-0">Posted by club name</p>
                </div>
                <div class="modal-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                    laborum. Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a
                    volutpat diam
                    tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique
                    orci
                    libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. </p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- modal -->
        <div class="headline-container" data-toggle="modal" data-target="#myModal2">
          <div class="headline">
            <h1>Headline</h1>
            <p class="post-club-name">Posted by club name</p>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>
        <div> <!-- modal 2 -->
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1>Headline</h1>
                  <p class="post-club-name mb-0">Posted by club name</p>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat
                    diam
                    tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique
                    orci
                    libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum
                    ac
                    diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- modal 2 -->
        <div class="headline-container" data-toggle="modal" data-target="#myModal3">
          <div class="headline">
            <h1>Headline</h1>
            <p class="post-club-name">Posted by club name</p>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>
        <div> <!-- modal 3 -->
          <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1>Headline</h1>
                  <p class="post-club-name mb-0">Posted by club name</p>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat
                    diam
                    tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique
                    orci
                    libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum
                    ac
                    diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="headline-container" data-toggle="modal" data-target="#myModal4">
          <div class="headline">
            <h1>Headline</h1>
            <p class="post-club-name">Posted by club name</p>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>
        <div> <!-- modal 4 -->
          <div class="modal fade" id="myModal4" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1>Headline</h1>
                  <p class="post-club-name mb-0">Posted by club name</p>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat
                    diam
                    tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique
                    orci
                    libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum
                    ac
                    diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- modal 4 -->
        <div class="headline-container" data-toggle="modal" data-target="#myModal5">
          <div class="headline">
            <h1>Headline</h1>
            <p class="post-club-name">Posted by club name</p>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>
        <div> <!-- modal 5 -->
          <div class="modal fade" id="myModal5" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1>Headline</h1>
                  <p class="post-club-name mb-0">Posted by club name</p>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat
                    diam
                    tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique
                    orci
                    libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum
                    ac
                    diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- modal 5 -->
      </div>
    </div>
  </div>
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
