<?php 
include ('server.php') 
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Welcome</title>

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
    <a href="/" class="navbar-brand d-flex w-50 mr-auto"><img class="logo" src="/images/connect-me-logo2.png"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
            <li class="nav-item">
                <a class="nav-link navbar-nav-link border-0 mr-4" href="club-stream-superuser.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-0 mr-4" href="club-directory-superuser.php">Explore</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-0 mr-4" href="pending-approval.php">Pending Approval</a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <img class="navbar-profile-pic dropbtn" src="/images/blank-avatar-green.png" onclick="myFunction()">
                <div id="myDropdown" class="dropdown-content">
                  <a href="index.php">Sign Out</a>
                </div>
              </div>
            </li>
        </ul>
    </div>
  </nav>

  <div class="container mt-4 text-center">
    <div class="jumbotron d-flex flex-column justify-content-center align-items-center text-center">
      <h1>Application Requests</h1>
      <div class="accordion w-100 mt-3" id="accordionExample">
        <?php 
        //Setting Variables
        $club = array();
        $pendingClubs = mysqli_query($db, "SELECT * FROM clubapp.pendingClubs") or die(mysqli_error());
        while($row = mysqli_fetch_assoc($pendingClubs))
        {
          $club['Name'] = $row['clubName'];
          $club['Description'] = $row['clubDescription'];
          $club['ID'] = $row['ID'];
          $club['user'] = $row['user'];
          $club['dateSub'] = $row['submitTime'];
          ?>
          <!-- HTML -->
          <div class="card">
          <div class="card-header" id="headingTwo">
            <div class="mb-0 btn d-flex flex-row justify-content-between align-items-center collapseCard" id=<?php echo $club['ID']; ?> type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <p class="m-0 p-0" style="font-size: 18px;"><?php echo $club['Name']; ?></p>
              <p class="m-0 p-0" style="font-size: 12px;">Submitted By: <?php echo $club['user']; ?></p>
              <p class="m-0 p-0" style="font-size: 12px;"><?php echo $club['dateSub']; ?></p>
            </div>
          </div>
          <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body my-3" style="text-align:left">
              <?php echo $club['Description']; ?>
              <div class="mt-3 d-flex flex-row justify-content-center align-items-center">
                <a class="btn btn-primary mt-2 mr-3" href="#" role="button" style="background-color: #df0135; padding-left: 30px; padding-right: 30px;" id="approve">approve</a>
                <a class="btn btn-primary mt-2" style="padding-left: 35px; padding-right: 35px; background-color: #83848c" href="#" id="deny">deny</a>
              </div>
            </div>
          </div>
        </div>

        <?php
        }
        ?>
        
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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

  var approvalID;

  $('.collapseCard').click(function() {
    approvalID = $(this).attr('id');
  })

  $('#approve').click(function() {
    $.ajax ({
      type: 'POST',
      url: 'approvalProcessing.php',
      data: {approvalID: approvalID},
      success: function(result) {
        //alert(result);
        alert("Success!");
      }
    })
  })

  $('#deny').click(function() {
    $.ajax ({
      type: 'POST',
      url: 'denyProcessing.php',
      data: {approvalID: approvalID},
      success: function(result) {
        //alert(result);
        alert("Success!");
      }
    })
  })

  


  </script>
</body>

</html>
