<?php include('server.php'); ?>
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
    <div class="jumbotron d-flex flex-column align-items-center justify-content-start text-center">
      <div class="w-75 d-flex flex-column justify-content-center">

        <h1 class="mt-1">Create New Club</h1>
        <p class="mt-3 mb-0">What is the name of your club?</p>





        <form method="POST" action="New-Club.php">
          <div class="form-group d-flex flex-row justify-content-center">
            <textarea style="width: 300px; text-align: center; margin-top: 10px;" class="m-0 mt-2 form-control rounded-0" rows="1" name="newClubName" required></textarea>
          </div>
            <div style="margin-top: 30px;" class="mb-0">
              <p class="">Which tags best describe your club? (up to 2)</p>
              <div class="mt-3 mb-4 d-flex flex-row justify-content-center">
              <div class="d-flex flex-column align-items-start flex-wrap">
              <div class="d-flex justify-content-center">
                  <label class="thing mx-4">Art
                    <input type="checkbox" name="attribute[1]" value=1>
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="d-flex justify-content-center">
                  <label class="thing mx-4">Career
                    <input type="checkbox" name="attribute[2]" value=2>
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="d-flex justify-content-center">
                  <label class="thing mx-4">STEM
                    <input type="checkbox" name="attribute[3]" value=3>
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="d-flex flex-column align-items-start flex-wrap">
              <div class="d-flex justify-content-center">
                <label class="thing mx-4">Entertainment
                  <input type="checkbox" name="attribute[4]" value=4>
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="d-flex justify-content-center">
                <label class="thing mx-4">Awareness
                  <input type="checkbox" name="attribute[5]" value=5>
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="d-flex justify-content-center">
                <label class="thing mx-4">Language
                  <input type="checkbox" name="attribute[6]" value=6>
                  <span class="checkmark"></span>
                </label>
              </div>
              </div>
              <div class="d-flex flex-column align-items-start flex-wrap">
              <div class="d-flex justify-content-center">
                <label class="thing mx-4">Sports
                  <input type="checkbox" name="attribute[7]" value=7>
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="d-flex justify-content-center">
                <label class="thing mx-4">Media
                  <input type="checkbox" name="attribute[8]" value=8>
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="d-flex justify-content-center">
                <label class="thing mx-4">Service
                  <input type="checkbox" name="attribute[9]" value=9>
                  <span class="checkmark"></span>
                </label>
              </div>
              </div>
            </div>
        </div>
        <p>Describe your club's purpose.</p>
        <div class="d-flex flex-row justify-content-center">
          <textarea style="width: 500px;" class=" form-control rounded-0" rows="4" name="headline" placeholder="" required></textarea>
        </div>
        <a class="btn btn-primary mt-3 mb-2" style="color: white;" data-toggle="modal" data-target="#finished">submit</a>
        <div class="modal fade" id="finished" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal">
            <div class="modal-content">
              <div class="modal-header d-flex flex-column align-items-center">
                <div>
                  <h3 class="mb-4">All Finished!</h3>
                </div>
                <hr class="w-100 mt-0">
                <div class="d-flex flex-row justify-content-center">
                  <button type="submit" href="New-Club.php" class="btn btn-primary d-flex flex-row justify-content-center mb-2 mt-3" role="button">ok</button>
                </form>





                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
        <?php
          if (isset($_POST['headline']) && isset($_POST['newClubName']) && isset($_POST['attribute']))
          {
            $clubDescription = mysqli_real_escape_string($db, $_POST['headline']);
            $clubName = mysqli_real_escape_string($db, $_POST['newClubName']);
            $clubTag = $_POST['attribute'];

            $i = 0; $tagOne; $tagTwo; $tagsSelected = array(2);
            foreach($clubTag as $tag) {
              settype($tag, "int");
              $tagsSelected[$i] = $tag;
              $i++;
            }
            if(!isset($tagsSelected[1]))
              $tagsSelected[1] = 0;

            $tagOne = $tagsSelected[0];
            $tagTwo = $tagsSelected[1];

            $stmt = mysqli_query($db, "INSERT INTO pending(ClubName, ClubDescription, tag1, tag2, user) VALUES ('$clubName', '$clubDescription', '$tagOne', '$tagTwo', 'potato')") or die(mysqli_error($db));

            echo "Finished!";
          }
        ?>
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

  <script>
$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 2) {
        $(this).prop('checked', false);
        alert("You may only check 2");
    }
});
</script>
</body>

</html>
