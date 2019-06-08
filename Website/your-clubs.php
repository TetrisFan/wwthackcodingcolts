<?php include ('server.php');
     // include('server2.php');
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
  <nav class="navbar justify-content-center justify-content-sm-between">
    <a class="navbar-brand" href="club-stream.php"> <img class="logo" src="images/connect-me-logo2.png"> </a>
    <div class="d-flex flex-row align-items-center">
      <a class="nav-link mr-5 b-0" href="club-stream.php">Home</a>
      <a class="nav-link mr-5 b-0 nav-link-active" href="club-directory.php">Explore</a>
      <div class="dropdown">
        <img class="navbar-profile-pic dropbtn" src="images/blank-avatar-green.png" onclick="myFunction()">
        <div id="myDropdown" class="dropdown-content">
          <a href="interest-quiz.php">Interest Quiz</a>
          <a href="your-clubs.php">Your Clubs</a>
          <a href="index.php">Sign Out</a>
        </div>
      </div>
    </div>
  </nav>

  <main role="main" class="container mt-4 d-flex flex-column">
    <div class="jumbotron d-flex flex-column align-items-center justify-content-center text-center">
      <div class="w-75 d-flex flex-column justify-content-center">
        <h1 class="mb-5">Your Clubs</h1>
        <div class="row d-flex flex-row justify-content-center">
          <?php
    $_SESSION['clubCounter'] = 0;
    $id = $_SESSION['studentid'];
    //print $id;
    //replacement
  	//$id = '3026263'; //test statment
    //$queryClub = "SELECT ClubID FROM clubapp.clubstudents WHERE StudentID = $id;";
    $resultsClub = mysqli_query($db, "SELECT * FROM clubapp.clubstudents WHERE GoogleStudentID = $id;");
    while($rowClub=mysqli_fetch_array($resultsClub))
    	{
    		$club['ClubID'] = $rowClub['ClubID'];
    		$club['Officer']= $rowClub['Officer'];

    		$resultfromclub = mysqli_query($db,"SELECT * FROM clubapp.club WHERE ClubID = ".$club['ClubID']);//or die (mysqli_error($db));
    		while (($rowTwo = mysqli_fetch_assoc($resultfromclub)) )
    		{
          $ClubIcon['icon'] = $rowTwo['icon'];
    			$ClubName['Clubname']  = $rowTwo['ClubName'];
    		}

    	if($club['Officer'] == 1)
                {
   ?>
         <form action="club-profile-admin.php" method="post">
           <div class="col-lg-3 col-md-4 col-xs-6 d-flex mx-auto justify-content-center">
             <input type="checkbox" style="display: none;" name = "c1" value=<?php echo $ClubName["Clubname"];?> checked></input>
             <div class= "container1">
               <img class="your-clubs-thumbnails" src="<?php echo $ClubIcon["icon"];?>" alt="">
               <button href="club-profile-admin.php" class="btn btn-link d-flex mx-auto" type="submit"><?php echo $ClubName["Clubname"];?></button>
               <p class="club-role"> Officer </p>
             </div>
           </div>
         </form>
  <?php
				}
                else
                {
  	?>
    <form action="club-profile.php" method="post">
      <div class="col-lg-3 col-md-4 col-xs-6 d-flex mx-auto justify-content-center">
        <input type="checkbox" style="display: none;" name = "c1" value=<?php echo $ClubName["Clubname"];?> checked></input>
        <div class= "container1">
          <img class="your-clubs-thumbnails" src="<?php echo $ClubIcon["icon"];?>" alt="">
          <button href="club-profile.php" class="btn btn-link d-flex mx-auto" type="submit"><?php echo $ClubName["Clubname"];?></button>
        </div>
      </div>
    </form>
     <?php
    		}
    	}
   	?>

    <!-- NEW CLUB BUTTON -->
    <form action="New-Club.php" method="post">
      <div class="col-lg-3 col-md-4 col-xs-6 d-flex mx-auto justify-content-center">
        <input type="checkbox" style="display: none;" name = "new_club_button" value="" checked></input>
        <div class= "container1">
          <img class="your-clubs-thumbnails" src="#" alt="Get pic from design plz">
          <button href="New-Club.php" class="btn btn-link d-flex mx-auto" type="submit">Create New</button>
        </div>
      </div>
    </form>

        </div>
      </div>
    </div>
    </div>


  </main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
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
  <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</body>

</html>
