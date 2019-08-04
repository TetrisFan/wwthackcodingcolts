<?php
include ('server.php');

//These will eventually be replaced with sesssion variables, but for now:
//$clubName = isset($_POST['c1'])?$_POST['c1']:"";\

if (!isset($_SESSION['clubadmin']))
{
  $_SESSION['clubadmin'] = 0;
}
if ($_SESSION['clubadmin'] !== "true")
{
  die("Access Denied.");
}

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
/*
$queryForUserInfo = "SELECT * FROM clubapp.clubstudents WHERE ClubID = ? AND GoogleStudentID = ?";
$prepEin = $mysqli->prepare($queryForUserInfo);
$userInfo = $prepEin->bind_param("ii", $currentClubID, $_SESSION['studentid']);

while ($row = mysqli_fetch_assoc($userInfo))
{
  $studentInClub['ID'] = $userInfo['GoogleStudentID'];
  $studentInClub['Officer'] = $userInfo['Officer'];
}
*/
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
            <button class="btn btn-primary mb-3 mt-2" type="button" data-toggle="collapse" data-target="#editDesc" aria-expanded="false" aria-controls="editDesc" name="editDesc" onClick="getCurrentDesc()">
              Edit club description
            </button>
            <div class="collapse w-100 mt-3" id="editDesc">
              <form class = "form-signin" method="post" action="club-profile-admin.php">
                <div class="form-group">
                  <textarea class="form-control rounded-0" rows="10" name="clubdesc" placeholder="Edit your club description." id="edit-desc-textarea"></textarea>
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
                              $students['StudentID'] = $row['GoogleStudentID'];
                              $students['Officer'] = $row['Officer'];
                                  $resultforStudent = mysqli_query($db, "SELECT * FROM googlelogin WHERE uid = " . $students['StudentID']) or die(mysqli_error($db));
                                   while(($rowTwo = mysqli_fetch_assoc($resultforStudent)))
                                   {
                                       $studentInfo['firstname'] = $rowTwo['first_name'];
                                       $studentInfo['lastname'] = $rowTwo['last_name'];
                                       $studentsProcessed = str_replace(' ', '', $studentInfo['lastname']);
                                       $studentInfo['id'] = $rowTwo['uid'];
                                       $studentInfo['Officer'] = $students['Officer'];
                                       //$studentInfo['LastName'] = $rowTwo['LastName'];
                                   }

                              if($students['Officer'] == 1)
                              {
                                ?>
                            <form action="club-profile-admin.php" method="post">
           <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
                              <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="" data-toggle="modal" data-target="#remove-member" id=<?php echo $studentInfo['id'] . "/" . $studentInfo['firstname'] . "/" . $studentsProcessed . "/" . $studentInfo['Officer'];?>>
                              <button href type="submit" style = "background-color: white;">
                              <a > <?php echo $studentInfo["firstname"]." ".$studentInfo["lastname"];?>  </a>
                              <p class="club-role">Officer</p>
             <input type="checkbox" style="display: none;" name = "member" value=<?php echo $studentInfo['id']?> checked></input>
           </div>
         </form>

                        <?php }
                              else if ($students['Officer'] == 2)
                              {
                                ?>
                                <form action="club-profile-admin.php" method="post">
                                  <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
                                        <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="" data-toggle="modal" data-target="#remove-member" id=<?php echo $studentInfo['id'] . "/" . $studentInfo['firstname'] . "/" . $studentsProcessed . "/" . $studentInfo['Officer'];?>>
                                        <button href type="submit" style = "background-color: white;">
                                        <a > <?php echo $studentInfo["firstname"]." ".$studentInfo["lastname"];?>  </a>
                                        <p class="club-role">Sub-Officer</p>
                                    <input type="checkbox" style="display: none;" name = "member" value=<?php echo $studentInfo['id']?> checked></input>
                                  </div>
                              </form>
                              <?php
                              }
                              else
                              {
                                ?>

                           <form action="club-profile-admin.php" method="post">
           <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
                              <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="" data-toggle="modal" data-target="#remove-member" id=<?php echo $studentInfo['id'] . "/" . $studentInfo['firstname'] . "/" . $studentsProcessed . "/" . $studentInfo['Officer'];?>>
                              <button href type="submit" style = "background-color: white;">
                              <a> <?php echo $studentInfo["firstname"]." ".$studentInfo["lastname"];?> </a>
                             

             <input type="checkbox" style="display: none;" name = "member" value=<?php echo $studentInfo['id']?> checked></input>
           </div>
         </form>


            <!--

             <form  method="post">
           <div class="col-lg-3 col-md-4 col-xs-6 d-flex flex-column align-items-center">
              <input type="checkbox" style="display: none;" name = "member" value=<?php echo $studentInfo['id']?> checked></input>
                              <img class="member-profile-pic" src="images/blank-avatar-green.png" alt="" >
                              <button class="btn btn-link d-flex mx-auto" data-toggle="modal" data-target="#remove-member" type="submit"><?php echo $studentInfo["firstname"]." ".$studentInfo["lastname"];?></button>
           </div>
         </form> -->




                              <?php
                              }
                              }

                              ?>

                                <!-- Modal stuff for removing members -->
        <div class="modal fade" id="remove-member" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header d-flex flex-column align-items-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div>
                  <h3 class="mb-3" id="needsMemberName">Error</h3>
                </div>
                <hr class="w-100 mt-0">
                <p class="mt-3 mb-4">How would you like to proceed?</p>
                <div class="d-flex flex-row justify-content-center">
                <form method="post" action="">
                <button href = "#" type="submit" class="btn btn-primary d-flex flex-row justify-content-center mb-2" id="member_remove" role="button" name="remove_student">Delete Member</button>
                  <div class="d-flex flex-row justify-content-center">
                    <button href = "club-profile-admin.php" type="submit" class="btn btn-primary d-flex flex-row justify-content-center ml-2 mr-2" id="member_promote" role="button" name="promote_member" style="background-color:#111753">Promote Member</button>
                    <button href = "club-profile-admin.php" type="submit" class="btn btn-primary d-flex flex-row justify-content-center ml-2" id="member_demote" role="button" name="demote_member" style="background-color:#660066">Demote Member</button>
                  </div>
                </form>
              
                </div>
              </div>
            </div>
          </div>
        </div><!-- edit modal -->
            </div>
          </div>

          <div class="btn btn-primary mt-5 mb-1" style="background-color: #111753;" data-toggle="modal" data-target="#confirm-leave">Leave Club</div>

          <div class="modal fade" id="#confirm-leave" role="dialog"> <!-- are you sure you want to leave? msg -->
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Are you sure you want to leave?</h4>
                </div>
                <div class="modal-body p-3">
                  <button class="btn btn-primary">leave club</button>
                </div>
              </div>
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

    <div class="headline-container">
      <div class="justify-content-end">
        <button type="button" class="close dropbtn-admin" onclick="openDropdown()">&#8942;</button>
        <div class="dropdown">
          <div id="adminDropdown" class="dropdown-content-admin">
            <button type="submit">remove</button> <!-- this is the remove post button, Ill leave it up to back end to put forms and stuff b/c I dont want to mess anything up -->
            <button type="submit" data-target="#edit-post" data-toggle="modal">edit</button> <!-- this button will pull up a modal similar to the one to create a new post, the modal is the big thing right under it. -->
              <div class="modal fade" id="edit-post" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                      <form class = "form-group" method="post" action="###">
                    <div class="modal-header d-flex flex-column align-items-center">
                      <button type="button" class="close mb-2" data-dismiss="modal">&times;</button>
                      <form class="w-100">
                        <div class="form-group">
                          <textarea class="form-control rounded-0" rows="1" name="headline" required></textarea>
                        </div>
                        <textarea class="form-control rounded-0" rows="10" name="desc" required></textarea>
                        <button type="submit" class="btn btn-primary mt-3" role="button" name="###">post</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div data-toggle="modal" data-target="#myModal1" class="headline">
        <h1>%s</h1>
        <p class="post-club-name">Posted by %s at %s</p>
      </div>
      <div data-toggle="modal" data-target="#myModal1" class="headline-text">%s</div>
    </div>');

 echo sprintf($FrontEnd, $post['Headline'],$User , $Time,  $Description, $Headline, $Description);
}

  ?>





  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <!--<script src="http://code.jquery.com/jquery-1.11.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- custom JS -->
  <script> //AJAX call for the current club description
    function getCurrentDesc() {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById('edit-desc-textarea').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET","getDescription.php", true);
        xhttp.send();
    }
  </script>
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

  <script> // Get the modal
  var modal = document.getElementById('myModal');

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.onclick = function() {
    modal.style.display = "flex";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
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

  <script>
    /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
    function openDropdown() {
      document.getElementById("adminDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn-admin')) {
        var dropdowns = document.getElementsByClassName("dropdown-content-admin");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openAdminDropdown = dropdowns[i];
          if (openAdminDropdown.classList.contains('show')) {
            openAdminDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
  <script>
  var id = "0";
  var site = window.location.pathname;
  var information;
    $('#member_remove').click(function(){
      $.ajax ({
        type: "GET",
        url: "deleteMember.php",
        data: {id: id},
        error: function(){
          altert('oof.');
        },
        success: function(){
          alert("User removed successfully.");
        }
      });
    });
    $('.member-profile-pic').click(function() {
      information = $(this).attr('id').split("/");
      //console.log($(this).attr('id').split("/"));
      console.log(information);
      id = information[0];
      var name = information[1] + " " + information[2];
      console.log(name);
      history.pushState(null, '', site + "?id=" + id);
      document.getElementById("needsMemberName").innerHTML = name;
        });
    $('#member_promote').click(function() {
      if (information[3] != 1) 
      {
            $.ajax({
            type:'GET',
            url:'promoteMemberProcessing.php',
            data: {id: id},
            success: function(result) {
              alert(result);
              //console.log(result);
            },
            error: function(data) {
              alert("Something isn't quite right...");
            }
          })
        }
      
      else 
      {
        alert("Error: You don't have permission to do this.");
      }
    })
    $('#member_demote').click(function() {
      if (information[3] != 1) 
      {
            $.ajax ({
            type: 'GET',
            url: 'demoteMemberProcessing.php',
            data: {id: id},
            success: function(result) {
              alert(result);
              //console.log(result);
            },
            error: function(data) {
              alert("Something isn't quite right...");
            }
          })
        }
      else 
      {
        alert("You don't have permission to do this.");
      }
    })

  </script>
</body>

</html>
