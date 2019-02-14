<?php include('server.php')?>


<!doctype HTML>
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
  <nav class="navbar">
    <a class="navbar-brand" href="#">Logo</a>
    <div class="d-flex flex-row">
      <a class="nav-link mr-3 px-5 b-0" href="club-stream.html">Home</a>
      <a class="nav-link mr-3 px-5 b-0" href="club-directory.html">Explore</a>
    </div>
  </nav>

  <div class="filters d-flex flex-row justify-content-center align-items-center">
    <button type="checkbox" class="btn btn-filter">Art</button>
    <button type="checkbox" class="btn btn-filter">Entertainment</button>
    <button type="checkbox" class="btn btn-filter">Sports</button>
    <button type="checkbox" class="btn btn-filter">Career</button>
    <button type="checkbox" class="btn btn-filter">Awareness</button>
    <button type="checkbox" class="btn btn-filter">STEM</button>
    <button type="checkbox" class="btn btn-filter">Media</button>
    <button type="checkbox" class="btn btn-filter">Service</button>
    <button type="checkbox" class="btn btn-filter m-0">Language</button>
  </div>
  <div class="card-club-deck d-flex flex-row justify-content-center mb-3 mt-3">
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
  </div>
  <div class="card-club-deck d-flex flex-row justify-content-center mb-3">
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
  </div>
  <div class="card-club-deck d-flex flex-row justify-content-center">
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
    <div class="card-club">
      <img class="card-club-img-top" src="images/gray.png" alt="card-club image cap">
      <div class="card-club-body">
        <h5 class="card-club-title">club name</h5>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</body>

</html>