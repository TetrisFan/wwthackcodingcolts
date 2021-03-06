<?php 


$servername = "localhost";
$username = "root";
$password = "PASSWORD";

//These will eventually be replaced with sesssion variables, but for now:
$clubName = 'Art Club';
$currentClubID = 1;
$currentUserID = 65;


$conn = new mysqli($servername, $username, $password, "clubapp");


$result = mysqli_query($conn, "SELECT * FROM club WHERE ClubName =  '".$clubName."'") or die(mysqli_error($conn));

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}


$club = array();
$students = array();
$studentInfo = array();
$currentClub = array();
$studentInClub = array();

while(($row = mysqli_fetch_assoc($result)))
{
    $club['ID'] = $row['ClubID'];
    $club['Name'] = $row['ClubName'];
    $club['Description'] = $row['ClubDescription'];
}

//print_r($club);

$resultStudents = mysqli_query($conn, "SELECT * FROM clubstudents WHERE clubID =  '".$currentClubID."'") or die(mysqli_error($conn));

$resultStudentsForInsertion = mysqli_query($conn, "SELECT * FROM clubstudents WHERE clubID = 1") or die(mysqli_error($conn));



?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Club Profile</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <nav class="navbar mb-4">
    <a class="navbar-brand" href="#">Logo</a>
  </nav>

  <!-- <img src="#banner"/> -->
  <div class="nav-container">
    <ul class="nav nav-pills justify-content-center align-items-center" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active px-sm-5 px-lg-5" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-lg-5 px-md-5" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-lg-5 px-md-5" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
      </li>
    </ul>
  </div>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <main role="main" class="container mt-5">
        <div class="jumbotron d-flex flex-column align-items-center text-center">
          <div class="w-75 d-flex flex-column align-items-center">
            <h1><?php echo $club['Name']?></h1>
            <p><?php echo $club['Description']?></p>
            <form action="club-profile.php" method='post'>
                <button type="submit" class="btn btn-primary mt-3 mb-3" name='join'>join now</button>
            </form>  
            <?php 
             if(isset($_POST['join']))
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
                 
              echo $counter . "<br>";
                 
                if ($counter == 0)
                {
                  echo "executing statement <br>";
                  $stmt = $conn->prepare("INSERT INTO clubstudents (ClubID,StudentID,Officer) VALUES(?,?,?)") or die(mysqli_error($conn));
                  $stmt->bind_param("iii", $ClubID, $Student,$Officer);
                  //setting params
                  $ClubID = $currentClubID;
                  $Student = $currentUserID;
                  $Officer=0;
                  //if(!$stmt->execute()) echo $stmt->error;
                  $stmt->execute();
                  $counter ++;  
                  echo "Finished!";
                 }
                    
                
                 
                
              }
              
                            
              ?>
            
            
            
            
            <hr>
            <h1 class="mt-3 mb-3">Members</h1>
            <form class="form-inline w-100 m-0 mb-4">
              <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="row d-flex flex-row justify-content-center">
              <?php 
                while(($row = mysqli_fetch_assoc($resultStudents)))
                {
                $students['StudentID'] = $row['StudentID'];
                $students['Officer'] = $row['Officer'];
                    $resultforStudent = mysqli_query($conn, "SELECT * FROM users WHERE StudentID = " . $students['StudentID']) or die(mysqli_error($conn));
                     while(($rowTwo = mysqli_fetch_assoc($resultforStudent)))
                     {
                         $studentInfo['FirstName'] = $rowTwo['FirstName'];
                         $studentInfo['LastName'] = $rowTwo['LastName'];
                     }
                if($students['Officer'] == 1)
                {
                echo '<div class="col-lg-3 col-md-4 col-xs-6">
                <img class="member-profile-pic" src="images/gray.png" alt="">
                <p class="mb-0"> ' . $studentInfo["FirstName"] ." ". $studentInfo["LastName"] . '</p>
                <p class="club-role">Officer</p>
              </div>';
                }
                else 
                {
                  echo '<div class="col-lg-3 col-md-4 col-xs-6">
                <img class="member-profile-pic" src="images/gray.png" alt="">
                <p class="mb-0"> ' . $studentInfo["FirstName"] ." ". $studentInfo["LastName"] . '</p>
                <p class="club-role">Member</p>
              </div>';
                }
                }?>
              </div> 
            </div>
          </div>
        </div>
      </main>
    </div>
    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
      <main role="main" class="container text-center mt-5 d-flex flex-column align-items-center">
        <div data-toggle="modal" data-target="#myModal1" class="headline-container">
          <div class="headline">
            <h1>Headline</h1>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>
        <div>
          <!-- Modal -->
          <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat diam tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique orci libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum ac diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="headline-container" data-toggle="modal" data-target="#myModal2">
          <div class="headline">
            <h1>Headline</h1>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>

        <div>
          <!-- Modal -->
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat diam tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique orci libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum ac diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="headline-container"  data-toggle="modal" data-target="#myModal3">
          <div class="headline">
            <h1>Headline</h1>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>

        <div>
          <!-- Modal -->
          <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat diam tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique orci libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum ac diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="headline-container"  data-toggle="modal" data-target="#myModal4">
          <div class="headline">
            <h1>Headline</h1>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>

        <div>
          <!-- Modal -->
          <div class="modal fade" id="myModal4" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat diam tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique orci libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum ac diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="headline-container" data-toggle="modal" data-target="#myModal5">
          <div class="headline">
            <h1>Headline</h1>
          </div>
          <div class="headline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>

        <div>
          <!-- Modal -->
          <div class="modal fade" id="myModal5" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header d-flex flex-column align-items-center">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Donec condimentum erat a arcu pretium, consequat iaculis lacus tincidunt. Vivamus gravida eros tortor. Praesent iaculis in ligula id vehicula. Nunc vehicula, eros nec efficitur laoreet, ligula turpis commodo felis, a volutpat diam tellus ac dolor. Donec nulla nisi, luctus eget justo id, auctor elementum turpis. Praesent faucibus felis ante, nec posuere ligula efficitur sit amet. Ut aliquet, eros a vehicula viverra, augue est dapibus lorem, quis tristique orci libero sed ante. Aenean placerat augue at lectus porttitor, et elementum nibh consequat. Morbi facilisis ipsum in posuere euismod. Pellentesque porttitor convallis porttitor. Fusce dolor risus, tincidunt et pulvinar in, interdum ac diam. Aenean imperdiet libero molestie, lacinia arcu id, lacinia magna. Fusce accumsan erat eget pulvinar blandit. Sed et nunc est. Proin at consequat augue, sed dignissim tellus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
      <main role="main" class="container h-75 text-center mt-5">
        <div class="jumbotron d-flex flex-column justify-content-center align-items-center">
          <div class="card-deck">
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
          </div>
          <div class="card-deck">
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/gray.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">file</h5>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</body>

</html>
