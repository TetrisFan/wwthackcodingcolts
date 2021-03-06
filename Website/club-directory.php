<?php 
include('server.php');
include('server3.php');
  // Create Query
  $query = 'SELECT clubapp.club.ClubName, clubapp.club.ClubID, clubapp.tag.TagName, clubapp.club.image
      FROM club
      INNER JOIN clubtag ON club.ClubID = clubtag.ClubID
      INNER JOIN tag ON clubtag.TagID = tag.TagID
      ORDER BY club.ClubName';

  // Get Result
  $result = mysqli_query($db, $query);
  // Fetch Data
  $clubInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Free Result
  mysqli_free_result($result);
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Club Directory</title>

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
        <ul class="navbar-nav w-100 justify-content-center">
          <!-- Search form -->
          <input class="form-control w-100 nav-search-bar" style="border-radius: 18px;" type="text" placeholder="Search" aria-label="Search">
        </ul>
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

  <div class="filters">
    <form method = "POST" class="d-flex flex-wrap flex-row justify-content-center align-items-center">
      <input id="art" type="checkbox" name="filter[1]" value="Arts"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="art">Art</label>
      <input id="entertainment" type="checkbox" name="filter[2]" value="Entertainment" />
      <label class="btn-filter btn mb-2 mb-xl-0" for="entertainment">Entertainment</label>
      <input id="sports" type="checkbox" name="filter[3]" value="Sports"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="sports">Sports</label>
      <input id="career" type="checkbox" name="filter[4]" value="Career"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="career">Career</label>
      <input id="awareness" type="checkbox" name="filter[5]" value="Awareness"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="awareness">Awareness</label>
      <input id="stem" type="checkbox" name="filter[6]" value="STEM"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="stem">STEM</label>
      <input id="media" type="checkbox" name="filter[7]" value="Media"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="media">Media</label>
      <input id="service" type="checkbox" name="filter[8]" value="Service"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="service">Service</label>
      <input id="language" type="checkbox" name="filter[9]" value="Language"/>
      <label class="btn-filter btn mb-2 mb-xl-0" for="language">Language</label>
      <button role="submit" class="btn btn-filter-submit mb-sm-2 mb-xl-0">Apply Changes</button>
    </form>
  </div>
  <div class="container">
  <div class="d-flex flex-column">
    <?php
      $clubCounter = 0;
      $numOfClubs = count($clubInfo);
      if(isset($_POST['filter'])) :
    ?>
      <div class="card-deck mt-4 d-flex flex-row justify-content-center"> <!-- in a deck of cards, there are 4 individual cards -->
        <?php
          while($clubCounter < $numOfClubs) :
            $info = $clubInfo["$clubCounter"];
            foreach($_POST['filter'] as $tag) :
              if($tag == $info['TagName']) :
        ?>
          <form action="club-profile.php" method = "POST">
            <input type="checkbox" style="display: none;" name = "c1" value="<?php echo $info['ClubName'];?>" checked>
            <button href = "club-profile.php" class="club-card" type="submit">
             <div class="">
               <img class="club-card-img-top" src="<?php echo $info['image']; ?>" />
               <div class="club-card-body">
                 <h5 class="club-card-title">
                   <?php
                     echo $info['ClubName'];
                   ?>
                </h5>
              </div>
             </div>
            </button>
          </form>
        <?php
              endif;
            endforeach;
            $clubCounter++;
          endwhile;
        ?>
      </div>
    <?php
      endif;
      if(!isset($_POST['filter'])) :
    ?>
      <div class="card-deck mt-4 d-flex flex-column flex-sm-row align-items-center justify-content-sm-center"> <!-- in a deck of cards, there are 4 individual cards -->
        <?php
          while($clubCounter < $numOfClubs) :
            $info = $clubInfo["$clubCounter"];
        ?>
          <form action="club-profile.php" method = "POST">
            <input type="checkbox" style="display: none;" name = "c1" value="<?php echo $info['ClubName'];?>" checked>
            <button href = "club-profile.php" class="club-card" type="submit">
             <div class="">
               <img class="club-card-img-top" src="<?php echo $info['image']; ?>" />
               <div class="club-card-body">
                 <h5 class="club-card-title">
                   <?php
                     echo $info['ClubName'];
                   ?>
                </h5>
              </div>
             </div>
            </button>
          </form>
        <?php
          $clubCounter++;
          endwhile;
        ?>
      </div>
    <?php endif;?>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script>
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
