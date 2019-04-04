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

<script>


	var id;
  var name;
  var image;
  var email;

  function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  id = profile.getId(); // Do not send to your backend! Use an ID token instead.
  firstname = profile.getGivenName();
	lastname = profile.getFamilyName();
	image = profile.getImageUrl();
  email = profile.getEmail(); // This is null if the 'email' scope is not present.
  //document.write(id);
  //document.write(firstname);
	//document.write(lastname);
  //document.write(image);
  //document.write(email);
	<?php
	 $id =  "document.write(id);";

	?>
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
</body>
</html>
