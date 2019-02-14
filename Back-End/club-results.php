<?php include('filterclubquiz.php')?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Club Results</title>

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
    <div class="d-flex flex-row">
      <a class="nav-link mr-3 px-5 b-0" href="club-stream.html">Home</a>
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

  <main role="main" class="container text-center">
    <div class="jumbotron d-flex flex-column justify-content-around align-items-center text-center">
      <!--<img src="#" class="img-fluid" alt="Illustration">-->
      <h1 style="margin-bottom: 10px;">Results</h1>
      <div class="w-75">
        <p>These are the clubs that best match your interests based on your quiz responses.</br> If they seem appealing, check them out!</p>
        <a class="btn btn-primary" style="margin-top: 10px" href="club-stream.html" role="button">go to home</a>
      </div>

      <hr class="my-3">

      <div class="row mx-0 d-flex flex-row justify-content-center">
         <?php 

               $list = $_SESSION['clubnames'];
               echo count($list);
               print_r($list);
               if (count($list)%2 == 0)
               {
               for ($counter = 0; $counter<count($list); $counter +=2)
                 { 
              ?>
        <div class="row mx-0 d-flex flex-row justify-content-center">
          <div class="col-sm-12 col-md-6 col-lg mb-2">
          <div class="d-flex flex-row justify-content-center">
            <img class="club-profile-pic" src="images/gray.png" />
            <a href="club-profile.html" class="club-name"><?php echo $list[$counter]; ?></a>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg mb-2">
          <div class="d-flex flex-row justify-content-center">
            <img class="club-profile-pic" src="images/gray.png" />
            <a href="club-profile.html" class="club-name"><?php echo $list[$counter+1]; ?></a>
          </div>
        </div>
      </div>
        
          
          <?php
                  }}
                else {
                  for ($counter = 0; $counter<count($list)-1; $counter +=2)
                 { 
              ?>
        <div class="row mx-0 d-flex flex-row justify-content-center">
          <div class="col-sm-12 col-md-6 col-lg mb-2">
          <div class="d-flex flex-row justify-content-center">
            <img class="club-profile-pic" src="images/gray.png" />
            <a href="club-profile.html" class="club-name"><?php echo $list[$counter]; ?></a>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg mb-2">
          <div class="d-flex flex-row justify-content-center">
            <img class="club-profile-pic" src="images/gray.png" />
            <a href="club-profile.html" class="club-name"><?php echo $list[$counter+1]; ?></a>
            </div>
        </div>
      </div>
      <?php
                } ?>

      <div class="col-sm-12 col-md-6 col-lg mb-2">
          <div class="d-flex flex-row justify-content-center">
            <img class="club-profile-pic" src="images/gray.png" />
            <a href="club-profile.html" class="club-name"><?php echo $list[$counter]; ?></a>
            </div>
        </div>

              <?php  }
          ?> 
       
        
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
  <script>
  </script>
</body>

</html>
