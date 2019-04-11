<!doctype html>
<html lang="en-Us">
	<title>Login with Google</title>
	<meta charset="utf-8">

	<!-- Lead the google platform library-->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<!-- Client ID-->
	<meta name="google-signin-client_id" content="769852908270-a7p3d2pmgaefvgssovgijj2jveivsjiv.apps.googleusercontent.com">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ConnectMe</title>

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
    <a class="navbar-brand" href="index.html"><img class="logo" src="images/connect-me-logo2.png"></a>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <!--<div class="d-flex flex-row">
      <a class="nav-link text-secondary" href="signin.php">Sign In</a>
    </div>-->
   

  </nav>
<script>
 // document.write("Hello");
  </script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript"> 
  var uid;
  var firstname;
  var lastname;
  var image;
  var email;

//documnet.write("Hello");
  function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  uid = String(profile.getId()); // Do not send to your backend! Use an ID token instead.
  firstname = String(profile.getGivenName());
	lastname = String(profile.getFamilyName());
	image = String(profile.getImageUrl());
  email = String(profile.getEmail()); // This is null if the 'email' scope is not present.
  



//call ajax
$.ajax({
            type: 'POST',
            url: 'server2.php',
            data:  {uid:uid,firstname:firstname,lastname:lastname,image:image,email:email},
             success: function(result) {
                $('#sonuc').html(result);
            },
            error: function() {
                alert('Some error found. Please try again!');
            }
    });
window.location.replace('./club-stream.php');
}


</script>




<p id ='sonuc'></p>  <!-- execute the ajax calling -->
 <div class="container-fluid d-flex flex-column justify-content-center align-items-center" style="height: 90%">
    <div class="d-flex flex-column justify-content-center align-items-center" style="z-index: 2;">
      <h1 class="mb-3 mt-4" style="font-size: 40px;">You belong here.</h1>
      <p class="mb-3" style="font-size: 20px;">There are countless clubs and organizations here waiting to connect with you!</p>
      <!--<div><a class="btn btn-primary shadow" style="z-index: 1; color: white; font-size: 18px" href="signup.php" role="button">Get Started</a></div>
    </div>-->
    <img class="img-fluid mt-3" style="max-width: 900px; width: 100%;" src="images/landing-page-white-floor.png" />
  </div>

  <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> The problem-->
  <script>
    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</body>
</html>
