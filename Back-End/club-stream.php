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
  <nav class="navbar mb-4">
    <a class="navbar-brand" href="#"> <img src="images/connect-me-logo2.png"> </a>
    <div class="d-flex flex-row">
      <a class="nav-link mr-3 px-5 b-0" href="#">Home</a>
      <a class="nav-link mr-3 px-5 b-0" href="club-directory.html">Explore</a>
      <div class="dropdown">
        <img class="member-profile-pic dropbtn" src="images/white.png" onclick="myFunction()">
        <div id="myDropdown" class="dropdown-content">
          <a href="student-profile.html">Your Profile</a>
          <a href="interest-quiz.html">Interest Quiz</a>
          <a href="#">Manage Clubs</a>
          <a href="index.html">Sign Out</a>
        </div>
      </div>
    </div>
  </nav>
<?php 

$resultsOfPosts = mysqli_query($db, "SELECT * FROM posts") or die(mysqli_error($db));
$post = array();
while(($row = mysqli_fetch_assoc($resultsOfPosts)))
{
    $clubName = "";
    $post['Description'] = $row['desc'];
    $post['Headline'] = $row['headline'];
    $post['ClubID'] = $row['id'];
    $Headline = $post['Headline'];
    $Description = $post['Description'];
    $resultsForClubs = mysqli_query($db, "SELECT * FROM club WHERE ClubID = '".$post['ClubID']."'") or die(mysqli_error($db));
    
    while(($clubrow = mysqli_fetch_assoc($resultsForClubs)))
    {
        $club['Name'] = $clubrow['ClubName'];
        $clubName = $club['Name'];
    }

    $FrontEnd = ('
  <main role="main" class="container text-center d-flex flex-column align-items-center">
    <div data-toggle="modal" data-target="#myModal1" class="headline-container">
      <div class="headline">
        <h1>%s</h1>
        <p class="post-club-name">%s</p>
      </div>
      <div class="headline-text">%s</div>
    </div>
    <div>
      
 '); 
 echo sprintf($FrontEnd, $post['Headline'],$clubName , $Description, $Headline, $Description);   
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