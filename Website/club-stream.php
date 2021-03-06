<?php include('server.php'); ?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Club Stream</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="styles.css">
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

<main role="main" class="container text-center d-flex flex-column align-items-center">
<?php
$id = $_SESSION['studentid'];

//personalized club stream
$resultsClub = mysqli_query($db, "SELECT ClubID FROM clubapp.clubstudents WHERE GoogleStudentID = $id;");
if ($resultsClub->num_rows === 0)
{
 $resultsOfPosts = mysqli_query($db, "SELECT * FROM posts ORDER BY time DESC;") or die(mysqli_error($db));
}
else
{
while($rowClub=mysqli_fetch_array($resultsClub))
      {
        $club[] = $rowClub['ClubID'];
      }
      $ids = join(",", $club);
//Get the posts
$resultsOfPosts = mysqli_query($db, "SELECT * FROM posts WHERE clubid IN ($ids) ORDER BY time DESC;") or die(mysqli_error($db));
}
$post = array();
while(($row = mysqli_fetch_assoc($resultsOfPosts)))
{
    $clubName = "";
    $post['Description'] = $row['desc'];
    $post['Headline'] = $row['headline'];
    $post['ClubID'] = $row['clubid'];
    $post['Time'] = $row['time'];
    $Headline = $post['Headline'];
    $Description = $post['Description'];
    $Time = $post['Time'];

    $resultsForClubs = mysqli_query($db, "SELECT * FROM club WHERE ClubID = '".$post["ClubID"]."'") or die(mysqli_error($db));
    while(($clubrow = mysqli_fetch_assoc($resultsForClubs)))
    {
        $club['Name'] = $clubrow['ClubName'];
        $clubName = $club['Name'];
    }

    $FrontEnd = ('

    <div data-toggle="modal" data-target="#myModal1" class="headline-container my-3">
      <div class="headline">
        <h1>%s</h1>
        <p class="post-club-name">%s at %s</p>
      </div>
      <div class="headline-text">%s</div>
    </div>

 ');

 echo sprintf($FrontEnd, $post['Headline'],$clubName , $Time,  $Description, $Headline, $Description);
}

  ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
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
  <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</body>

</html>
