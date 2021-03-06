
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
  <nav class="navbar justify-content-center justify-content-sm-between">
    <a class="navbar-brand" href="club-stream.php"> <img class="logo" src="images/connect-me-logo2.png"> </a>
    <div class="d-flex flex-row align-items-center">
      <a class="nav-link mr-5 b-0" href="club-stream-superuser.php">Home</a>
      <a class="nav-link mr-5 b-0 nav-link-active" href="club-directory-superuser.php">Explore</a>
     <a class="nav-link mr-5 b-0 nav-link-active" href="pending-approval.php">Pending Approval</a>
      <div class="dropdown">
        <img class="navbar-profile-pic dropbtn" src="images/blank-avatar-green.png" onclick="myFunction()">
        <div id="myDropdown" class="dropdown-content">
          <a href="index.php">Sign Out</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="stream-filters d-flex flex-row justify-content-center bg-white p-2" style="box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.1), 0 2px 2px 0 rgba(0, 0, 0, 0.1);">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" style="font-size: 20px;" data-toggle="dropdown">Filters<b class="ml-2 caret"></b></a>
      <ul class="dropdown-menu dropdown-menu-center multi-column columns-2 dropdown-center">
        <form style="margin-bottom: 0;">
          <div class="row d-flex flex-row justify-content-around" style="width: 320px; margin-left: 0; margin-right: 0;">
            <div class="col-sm d-flex flex-row justify-content-sm-center" style="max-width: 180px; margin-left: 0; margin-right: 0;">
              <ul class="multi-column-dropdown d-flex flex-column align-items-left">
                <li><input id="news" type="checkbox" name="filter[1]" value="News"/>
                <label class="btn m-0 p-0 pl-3" for="news" id="News">News</label></li>
                <li><input id="art" type="checkbox" name="filter[2]" value="Art"/>
                <label class="btn m-0 p-0 pl-3" for="art" id="Art">Art</label></li>
                <li><input id="awareness" type="checkbox" name="filter[3]" value="Awareness"/>
                <label class="btn m-0 p-0 pl-3" for="awareness" id="Awareness">Awareness</label></li>
                <li><input id="career" type="checkbox" name="filter[4]" value="Career"/>
                <label class="btn m-0 p-0 pl-3" for="career" id="Career">Career</label></li>
                <li><input id="entertainment" type="checkbox" name="filter[5]" value="Entertainment"/>
                <label class="btn m-0 p-0 pl-3" for="entertainment" id="Entertainment">Entertainment</label></li>
              </ul>
            </div>
            <div class="col-sm d-flex flex-row justify-content-sm-center" style="max-width: 140px; ">
              <ul class="multi-column-dropdown d-flex flex-column align-items-left">
                <li><input id="language" type="checkbox" name="filter[6]" value="Language"/>
                <label class="btn m-0 p-0 pl-3" for="language">Language</label></li>
                <li><input id="media" type="checkbox" name="filter[7]" value="Media"/>
                <label class="btn m-0 p-0 pl-3" for="media">Media</label></li>
                <li><input id="Service" type="checkbox" name="filter[8]" value="Service"/>
                <label class="btn m-0 p-0 pl-3" for="Service">Service</label></li>
                <li><input id="STEM" type="checkbox" name="filter[9]" value="STEM"/>
                <label class="btn m-0 p-0 pl-3" for="STEM">STEM</label></li>
                <li><input id="sports" type="checkbox" name="filter[10]" value="Sports"/>
                <label class="btn m-0 p-0 pl-3" for="sports">Sports</label></li>
              </ul>
            </div>
          </div>
          <hr style="margin-top: 7px; margin-bottom: 3px;"/>
          <div class="d-flex flex-row justify-content-center">
            <button role="submit" style="padding-left: 15px; padding-right: 15px; padding-top: 0px; padding-bottom: 0px" class="btn btn-filter-submit mt-2 mb-1">Apply Changes</button>
          </div>
        </form>
      </ul>
    </li>
  </div>

<main role="main" class="container text-center d-flex flex-column align-items-center" id="mainDocument">
  <script>
    var postID;
    function getResults()
    {
      $.ajax({
        url : "stream-results.php",
        success : function(result) {
          document.getElementById("mainDocument").innerHTML = result;
          //alert(result);
        }
      })
    }

    $(document).ready(function() {
      //setInterval(getResults, 1000);
      getResults();
    })
    var postID;
    $(document).on("click","#refresh", function() {
      getResults();
    })
    $(document).on("click", ".headline-container", function() {
      postID = $(this).attr('id');
    })
    $(document).on("click", "#post_delete", function() {
      console.log('Clicked.');
      $.ajax({
        type : 'POST',
        url : 'postDeleteProcessing.php',
        data : {postID : postID},
        success : function(result) {
          alert(result);
        }
      })
  })

  </script>
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
$(document).on("click", modal, function() {
  modal.style.display = "flex";
})

// When the user clicks on <span> (x), close the modal
$(document).on("click", "span", function() {
  modal.style.display = "none";
})

// When the user clicks anywhere outside of the modal, close it
$(document).on("click", "window", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
})
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
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</body>

</html>
