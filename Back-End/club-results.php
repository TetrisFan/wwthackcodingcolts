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

  <main role="main" class="container mt-4 text-center">
    <div class="jumbotron d-flex flex-column justify-content-center align-items-center text-center">
      <h1 class="mb-4">Results</h1>
      <div class="mb-4">
        <p>These are the clubs that best match your interests based on your quiz responses.</br> If they seem appealing, check them out!</p>
      </div>


        <?php

               $list = $_SESSION['clubnames'];

                    $images = array();

                    $query = "SELECT image FROM clubapp.club WHERE clubName = '$list[0]'";
                    $img1 = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($img1);

                    $query1 = "SELECT image FROM clubapp.club WHERE clubName = '$list[1]'";
                    $img1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_fetch_array($img1);

                    $query2 = "SELECT image FROM clubapp.club WHERE clubName = '$list[2]'";
                    $img2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_fetch_array($img2);

                    $query3 = "SELECT image FROM clubapp.club WHERE clubName = '$list[3]'";
                    $img3 = mysqli_query($conn, $query3);
                    $row3 = mysqli_fetch_array($img3);

                    array_push($images, "$row[0]", "$row1[0]", "$row2[0]", "$row3[0]");



              print_r($list);
               if (count($list)%2 == 0)
               {
               for ($counter = 0; $counter<count($list); $counter +=2)
                 {


              ?>
        <div class="row mx-0 d-flex flex-row justify-content-center">
      <form action="club-profile.php" method = "POST">
        <input type="checkbox" style="display: none;" name = "c1" value= <?php echo $list[$counter] ?> checked>
        <div class="col-sm-12 col-md-6 col-lg mb-4">
          <div class="d-flex flex-row justify-content-center align-items-center">
            <img class="club-profile-pic" src=" <?php echo $images[$counter]; ?>" />
            <button href="club-profile.php" class="club-name" type="submit"><?php echo $list[$counter];
              ?>
            </button>
          </div>
        </div>
      </form>
      <form action="club-profile.php"method = "POST">
        <input type="checkbox" style="display: none;" name = "c1" value=<?php echo $list[$counter+1];?> checked></input>
        <div class="col-sm-12 col-md-6 col-lg mb-4">
          <div class="d-flex flex-row justify-content-center align-items-center">
            <img class="club-profile-pic" src="<?php echo $images[$counter+1]; ?>" />
            <button href="club-profile.php" class="club-name" type="submit"><?php echo $list[$counter+1]; ?></button>
          </div>
        </div>
       </form>
       </div>
       <?php

                  }}
                else {
                  for ($counter = 0; $counter<count($list)-1; $counter +=2)
                 {
              ?>
       <div class="row mx-0 d-flex flex-row justify-content-center">
      <form action="club-profile.php" method = "POST">
        <input type="checkbox" style="display: none;" name = "c1" value= <?php echo $list[$counter] ?> checked>
        <div class="col-sm-12 col-md-6 col-lg mb-4">
          <div class="d-flex flex-row justify-content-center align-items-center">
            <img class="club-profile-pic" src="<?php echo $images[$counter]; ?>" />
            <button href="club-profile.php" class="club-name" type="submit"><?php echo $list[$counter];
              ?>
            </button>
          </div>
        </div>
      </form>
      <form action="club-profile.php"method = "POST">
        <input type="checkbox" style="display: none;" name = "c1" value=<?php echo $list[$counter+1];?> checked></input>
        <div class="col-sm-12 col-md-6 col-lg mb-4">
          <div class="d-flex flex-row justify-content-center align-items-center">
            <img class="club-profile-pic" src="<?php echo $images[$counter+1]; ?>" />
            <button href="club-profile.php" class="club-name" type="submit"><?php echo $list[$counter+1]; ?></button>
          </div>
        </div>
       </form>
       </div>
      <?php
                } ?>




      <form action="club-profile.php" method = "POST">
        <input type="checkbox" style="display: none;" name = "c1" value= <?php echo $list[$counter] ?> checked>
        <div class="col-sm-12 col-md-6 col-lg mb-4">
          <div class="d-flex flex-row justify-content-center align-items-center">
            <img class="club-profile-pic" src="images/gray.png" />
            <button href="club-profile.php" class="club-name" type="submit"><?php echo $list[$counter];
              ?>
            </button>
          </div>
        </div>
      </form>
          <?php  }


          ?>


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
  <script>
  </script>
</body>

</html>
