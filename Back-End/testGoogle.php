<!doctype html>
<html lang="en-Us">
	<title>Login with Google</title>
	<meta charset="utf-8">

	<!-- Lead the google platform library-->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<!-- Client ID-->
	<meta name="google-signin-client_id" content="769852908270-a7p3d2pmgaefvgssovgijj2jveivsjiv.apps.googleusercontent.com">

<head>
</head>
<body>
<div class="g-signin2" data-onsuccess="onSignIn"></div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript"> 
  var uid;
  var firstname;
  var lastname;
  var image;
  var email;

  function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  uid = String(profile.getId()); // Do not send to your backend! Use an ID token instead.
  firstname = String(profile.getGivenName());
	lastname = String(profile.getFamilyName());
	image = String(profile.getImageUrl());
  email = String(profile.getEmail()); // This is null if the 'email' scope is not present.

  //document.write(id);
  //document.write(firstname);
	//document.write(lastname);
  //document.write(image);
  //document.write(email);
  //document.write(uid);



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
}


</script>


<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
<p id ='sonuc' ></p>  <!-- execute the ajax calling -->
</body>
</html>
